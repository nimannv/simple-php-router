# Simple PHP Router

### What is it?
This is actually a very lightweight framework focused on routing requests. 
We consider our system as a tree of routes that manage requests and guide them to their specified functionality.
This is the way I'd rather see my simple projects.

### Why?
I know there are a lot of great frameworks to use in various languages. (laravel, django and etc), but, sometimes I just want to start a project and I want to focus on the structure of my system (like a tree) and nothing more! (Flask has helped me a bunch for this, however, I've been trying to make something easy and brief to use in **PHP**)

### How to Use:
1. Write your site tree on the **/code/router.json** file 
2. Write your functions on the **/code/app** directory on the **fuctionality.php** and the **middleware.php** .
3. run it!

### How to Run:
1. Specify your preferred port to use on **/site.conf** (Default is 8080)
2. run ```docker-compose up```



## This is the tree of a simple blog system:
![example tree](/README-assets/tree.svg)

Every route can have its own **function** and **middlewares**, or it can only append middleware for its children, or even be just a parent for some other routes.



