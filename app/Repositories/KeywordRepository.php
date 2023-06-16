<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Keyword;
use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use LaravelGoogleAds\Services\AdWordsService;
use Google\AdsApi\AdWords\AdWordsServices;
use Google\AdsApi\AdWords\AdWordsSession;
use Google\AdsApi\AdWords\AdWordsSessionBuilder;
use Google\AdsApi\AdWords\v201809\cm\Language;
use Google\AdsApi\AdWords\v201809\cm\NetworkSetting;
use Google\AdsApi\AdWords\v201809\cm\Paging;
use Google\AdsApi\AdWords\v201809\o\AttributeType;
use Google\AdsApi\AdWords\v201809\o\IdeaType;
use Google\AdsApi\AdWords\v201809\o\LanguageSearchParameter;
use Google\AdsApi\AdWords\v201809\o\NetworkSearchParameter;
use Google\AdsApi\AdWords\v201809\o\RelatedToQuerySearchParameter;
use Google\AdsApi\AdWords\v201809\o\RequestType;
use Google\AdsApi\AdWords\v201809\o\SeedAdGroupIdSearchParameter;
use Google\AdsApi\AdWords\v201809\o\TargetingIdeaSelector;
use Google\AdsApi\AdWords\v201809\o\TargetingIdeaService;
use Google\AdsApi\Common\OAuth2TokenBuilder;
use Google\AdsApi\Common\Util\MapEntries;

class KeywordRepository
{

    /**
     *
     *
     * @var AdWordsService
     */
    protected $adWordsService;

    /**
     * @param AdWordsService $adWordsService
     */
    public function __construct(AdWordsService $adWordsService)
    {
        $this->adWordsService = $adWordsService;
    }

    public function generate($seedkeyword, $page_limit = 10)
    {
        $NUM_OF_ATTEMPTS = 5;
        $attempts = 0;

        do {

            try
            {

                $targetingIdeaService = $this->adWordsService->getService(TargetingIdeaService::class);

                // Create selector.
                $selector = new TargetingIdeaSelector();
                $selector->setRequestType(RequestType::IDEAS);
                $selector->setIdeaType(IdeaType::KEYWORD);
                $selector->setRequestedAttributeTypes(
                    [
                        AttributeType::KEYWORD_TEXT,
                        AttributeType::SEARCH_VOLUME,
                        AttributeType::AVERAGE_CPC,
                        AttributeType::COMPETITION,
                        AttributeType::CATEGORY_PRODUCTS_AND_SERVICES
                    ]
                );

                $paging = new Paging();
                $paging->setStartIndex(0);
                $paging->setNumberResults(10);
                $selector->setPaging($paging);

                $searchParameters = [];
                // Create related to query search parameter.
                $relatedToQuerySearchParameter = new RelatedToQuerySearchParameter();
                $relatedToQuerySearchParameter->setQueries(
                    [
                        $seedkeyword
                    ]
                );
                $searchParameters[] = $relatedToQuerySearchParameter;


                $selector->setSearchParameters($searchParameters);
                $selector->setPaging(new Paging(0, $page_limit));

                // Get keyword ideas.
                $page = $targetingIdeaService->get($selector);



                // Print out some information for each targeting idea.
                $entries = $page->getEntries();
                if ($entries !== null) {

                    $answers = array();

                    foreach ($entries as $targetingIdea) {
                        $data = MapEntries::toAssociativeArray($targetingIdea->getData());
                        $keyword = $data[AttributeType::KEYWORD_TEXT]->getValue();
                        $searchVolume = ($data[AttributeType::SEARCH_VOLUME]->getValue() !== null)
                            ? $data[AttributeType::SEARCH_VOLUME]->getValue() : 0;
                        $averageCpc = $data[AttributeType::AVERAGE_CPC]->getValue();
                        $competition = $data[AttributeType::COMPETITION]->getValue();
                        $categoryIds = ($data[AttributeType::CATEGORY_PRODUCTS_AND_SERVICES]->getValue() === null)
                            ? $categoryIds = ''
                            : implode(
                                ', ',
                                $data[AttributeType::CATEGORY_PRODUCTS_AND_SERVICES]->getValue()
                            );
                        $answers[] = $keyword;
                        $this->create($keyword);
                    }
                }

                if (empty($entries)) {
                    return true;
                } else {
                    return $answers;
                }

            } catch (\Google\AdsApi\AdWords\v201809\cm\ApiException $exception) {
                $attempts++;
                sleep(60);
                continue;
            }

            break;

        } while($attempts < $NUM_OF_ATTEMPTS);

    }


    public function create($word)
    {
        try {

            $wordlist = Keyword::where('keyword', $word)->get();
            $wordCount = $wordlist->count();

            if($wordCount==0) {
                $keyword = new Keyword;
                $keyword->keyword = $word;
                $keyword->save();
            } else {
                $keyword = Keyword::where('keyword', $word)->increment('used');
            }

            return $keyword;
        } catch (\PDOException $e) {
            \Log::error($e->getMessage());
            abort(400);
        }

    }
}
