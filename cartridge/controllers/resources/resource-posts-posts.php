<?php

    //
    header('Content-Type: application/json');

    //
    use Posts\Connection as Connection;
    use Posts\Token as Token;
    use Posts\Post as Post;

    // connect to the PostgreSQL database
    $pdo = Connection::get()->connect();

    // STEP 1. Receive passed variables / information
    if(isset($_REQUEST['app'])){$request['app'] = clean($_REQUEST['app']);}
    if(isset($_REQUEST['domain'])){$request['domain'] = clean($_REQUEST['domain']);}
    if(isset($_REQUEST['token'])){$request['token'] = clean($_REQUEST['token']);}

    // INITIATE DATA CLEANSE
    if(isset($_REQUEST['id'])){$request['id'] = clean($_REQUEST['id']);}
    if(isset($_REQUEST['attributes'])){$request['attributes'] = clean($_REQUEST['attributes']);}
    if(isset($_REQUEST['body'])){$request['body'] = clean($_REQUEST['body']);}
    if(isset($_REQUEST['images'])){$request['images'] = clean($_REQUEST['images']);}
    if(isset($_REQUEST['closed'])){$request['closed'] = clean($_REQUEST['closed']);}
    if(isset($_REQUEST['deleted'])){$request['deleted'] = clean($_REQUEST['deleted']);}
    if(isset($_REQUEST['access'])){$request['access'] = clean($_REQUEST['access']);}
    if(isset($_REQUEST['host'])){$request['host'] = clean($_REQUEST['host']);}
    if(isset($_REQUEST['parent'])){$request['parent'] = clean($_REQUEST['parent']);}
    if(isset($_REQUEST['profile'])){$request['profile'] = clean($_REQUEST['profile']);}

    if(isset($_REQUEST['address'])){$request['address'] = clean($_REQUEST['address']);}
    if(isset($_REQUEST['category'])){$request['category'] = clean($_REQUEST['category']);}
    if(isset($_REQUEST['name'])){$request['name'] = clean($_REQUEST['name']);}
    if(isset($_REQUEST['service_type'])){$request['service_type'] = clean($_REQUEST['service_type']);}

    //
    switch ($_SERVER['REQUEST_METHOD']) {

        //
        case 'POST':

            try {

                // 
                $post = new Post($pdo);
            
                // insert a stock into the stocks table
                $id = $post->insertPost($request);

                $request['id'] = $id;

                $results = $post->selectPosts($request);

                $results = json_encode($results);
                
                //
                echo $results;
            
            } catch (\PDOException $e) {

                echo $e->getMessage();

            }

        break;

        //
        case 'GET':

            //
            if(isset($_REQUEST['per'])){$request['per'] = clean($_REQUEST['per']);}
            if(isset($_REQUEST['page'])){$request['page'] = clean($_REQUEST['page']);}
            if(isset($_REQUEST['limit'])){$request['limit'] = clean($_REQUEST['limit']);}        

            try {

                // 
                $post = new Post($pdo);

                // get all stocks data
                $results = $post->selectPosts($request);

                $results = json_encode($results);

                echo $results;

            } catch (\PDOException $e) {

                echo $e->getMessage();

            }

        break;

        //
        case 'PUT':

            try {

                // 
                $post = new Post($pdo);
            
                // insert a stock into the stocks table
                $id = $post->updatePost($request);

                $request['id'] = $id;

                $results = $post->selectPosts($request);

                $results = json_encode($results);

                echo $results;
            
            } catch (\PDOException $e) {

                echo $e->getMessage();

            }

        break;

        //
        case 'DELETE':

            try {

                // 
                $post = new Post($pdo);
            
                // insert a stock into the stocks table
                $id = $post->deletePost($request);

                echo 'The record ' . $id . ' has been deleted';
            
            } catch (\PDOException $e) {

                echo $e->getMessage();

            }

        break;

    }

?>
