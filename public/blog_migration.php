<?php

$servername = "localhost";

$remotedbname = "webitix_booksi";
$remoteusername = "webitix_booksi";
$remotepassword = "booksi";

$localdbname = "webitix_crm";
$localusername = "webitix_crm";
$localpassword = "36low1taeal8";

// Create remote connection
$remoteconn = new mysqli($servername, $remoteusername, $remotepassword, $remotedbname);
// Check remote connection
if ($remoteconn->connect_error) {
    die("Connection failed: " . $remoteconn->connect_error);
} 


$remotesql = "SELECT blog_contents.title, blog_contents.content, blogs.image, blogs.alias as slug, blogs.meta_keywords, blogs.meta_description, blogs.link_built, blogs.views, blogs.created_at, blogs.updated_at FROM blogs LEFT JOIN blog_contents ON blog_contents.blog_id = blogs.id WHERE blogs.status = 1";
$remoteresult = $remoteconn->query($remotesql);

if ($remoteresult->num_rows > 0) {
    // output data of each row
    while($row = $remoteresult->fetch_assoc()) {
        
       /* $localsql = "INSERT INTO blog (user_id, title, content, image, slug, meta_keywords, meta_description, views, link_built, status, created_at, updated_at) VALUES ('1', $row[title], $row[content], $row[image], $row[slug], $row[meta_keywords], $row[meta_description], $row[views], $row[link_built], '1', $row[created_at], $row[updated_at]);";
        
        
        if ($localconn->query($localsql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $localconn->error . "<br>";
        }          */
        
        
try {      

// Create local connection
$localconn = new PDO("mysql:host=$servername;dbname=$localdbname", $localusername, $localpassword);
// Check local connection
$localconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        
$stmt = $localconn->prepare("INSERT INTO blog (user_id, title, content, image, slug, meta_keywords, meta_description, views, link_built, status, created_at, updated_at) VALUES (:user_id, :title, :content, :image, :slug, :meta_keywords, :meta_description, :views, :link_built, :status, :created_at, :updated_at)");

$user_id = 1;
$title = $row['title'];
$content = $row['content'];
$image = $row['image'];
$slug = $row['slug'];
$meta_keywords = $row['meta_keywords'];
$meta_description = $row['meta_description'];
$views = $row['views'];
$link_built = $row['link_built'];
$status = 1;
$created_at = $row['created_at'];
$updated_at = $row['updated_at'];

$stmt->execute([
    'user_id' => $user_id,
    'title' => $title,
    'content' => $content,
    'image' => $image,
    'slug' => $slug,
    'meta_keywords' => $meta_keywords,
    'meta_description' => $meta_description,
    'views' => $views,
    'link_built' => $link_built,
    'status' => $status,
    'created_at' => $created_at,
    'updated_at' => $updated_at,    
]);

} catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage()."<br>";
    }

     
        
    }
} else {
    echo "0 results";
}
?>