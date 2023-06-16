<?php

namespace App\Repositories;

use App\Models\User;
use JiraRestApi\Issue\IssueService;
use JiraRestApi\Issue\IssueField;
use JiraRestApi\User\UserService;
use JiraRestApi\JiraException;

class JiraRepository
{
    public function create($projectKey, $summary, $description, $user = null)
    {

        try {
            $issueField = new IssueField();

            if($user) {
                $issueField->setProjectKey($projectKey)
                    ->setSummary($summary)
                    ->setAssigneeName($user)
                    ->setIssueType("Story")
                    ->setDescription($description);
            } else {
                $issueField->setProjectKey($projectKey)
                    ->setSummary($summary)
                    ->setIssueType("Story")
                    ->setDescription($description);
            }

            $issueService = new IssueService();

            $ret = $issueService->create($issueField);

        } catch (JiraException $e) {
            print("Error Occurred! " . $e->getMessage());
        }

    }


}
