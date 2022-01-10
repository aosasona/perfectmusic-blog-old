<?php

include("connect.php");

//MUSIC UPLOAD TABLE CREATION

$create = "CREATE TABLE IF NOT EXISTS music_upload (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    link VARCHAR(500) NOT NULL,
    thumb VARCHAR(500) NOT NULL,
    about TEXT NOT NULL,
    main VARCHAR(300) NOT NULL,
    feature VARCHAR(300),
    downloads INT(100) NOT NULL,
    updated VARCHAR(50) NOT NULL)";

mysql_query($create);

//VIDEO UPLOAD TABLE CREATION

$vid = "CREATE TABLE IF NOT EXISTS video_upload (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    link VARCHAR(500) NOT NULL,
    about TEXT NOT NULL,
    downloads INT(100) NOT NULL,
    updated VARCHAR(50) NOT NULL)";

mysql_query($vid);

//NEWS TABLE CREATION SCRIPT

$news = "CREATE TABLE IF NOT EXISTS news (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    thumb VARCHAR(500) NOT NULL,
    article TEXT NOT NULL,
    views INT(100) NOT NULL,
    likes INT(60) NOT NULL,
    dislikes INT(60) NOT NULL,
    updated VARCHAR(50) NOT NULL)";

mysql_query($news);

//FILES UPLOAD TABLE CREATION

$file = "CREATE TABLE IF NOT EXISTS files (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    link VARCHAR(500) NOT NULL,
    thumb VARCHAR(500) NOT NULL,
    about TEXT NOT NULL,
    downloads INT(100) NOT NULL,
    updated VARCHAR(50) NOT NULL)";

mysql_query($file);

//TOP ARTISTS TABLE CREATION

$artist = "CREATE TABLE IF NOT EXISTS artist (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(500) NOT NULL,
    photo VARCHAR(700) NOT NULL,
    position INT(100) NOT NULL,
    updated VARCHAR(50) NOT NULL)";

mysql_query($artist);

//TOP ARTISTS TABLE CREATION

$email_list = "CREATE TABLE IF NOT EXISTS email_list (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(500) NOT NULL,
    updated VARCHAR(50) NOT NULL)";

mysql_query($email_list);


//ADVERT TABLE CREATION

$ad = "CREATE TABLE IF NOT EXISTS advert (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(500) NOT NULL,
    link VARCHAR(500) NOT NULL,
    photo VARCHAR(600) NOT NULL)";

mysql_query($ad);

//AD DISPLAY SWITCH TABLE CREATION

$adstat = "CREATE TABLE IF NOT EXISTS ad_status (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    switch VARCHAR(500) NOT NULL,
    updated VARCHAR(500) NOT NULL)";

mysql_query($adstat);


//GIVEAWAY TABLE CREATION

$giv = "CREATE TABLE IF NOT EXISTS giveaway (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(500) NOT NULL,
    bank VARCHAR(500) NOT NULL,
    acc_no VARCHAR(500) NOT NULL,
    photo VARCHAR(500) NOT NULL,
    whatsapp VARCHAR(600) NOT NULL)";

mysql_query($giv);

//GIVEAWAY PORTAL SWITCH TABLE CREATION

$givstat = "CREATE TABLE IF NOT EXISTS giveaway_status (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    switch VARCHAR(500) NOT NULL,
    updated VARCHAR(500) NOT NULL)";

mysql_query($givstat);

//GIVEAWAY TABLE CREATION

$log = "CREATE TABLE IF NOT EXISTS visit_log (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    ip VARCHAR(500) NOT NULL,
    category VARCHAR(500) NOT NULL,
    fileid VARCHAR(500) NOT NULL)";

mysql_query($log);

//GIVEAWAY TABLE CREATION

$givedesc = "CREATE TABLE IF NOT EXISTS giveaway_description (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    describe TEXT NOT NULL)";

mysql_query($givedesc);


//ADD A NEW COLUMN FOR MORE IMAGES

$add_thumb2 = "ALTER TABLE news ADD thumb2 VARCHAR(800)";
mysql_query($add_thumb2);


//ADD A NEW COLUMN FOR MORE IMAGES

$add_thumb3 = "ALTER TABLE news ADD thumb3 VARCHAR(800)";
mysql_query($add_thumb3);


//ADD A NEW COLUMN FOR MORE IMAGES

$add_thumb4 = "ALTER TABLE news ADD thumb4 VARCHAR(800)";
mysql_query($add_thumb4);

//ADD A NEW COLUMN FOR AUDIOMACK

$add2 = "ALTER TABLE music_upload ADD audiomack VARCHAR(900)";
mysql_query($add2);

//Create a table to keep comments

$comment = "CREATE TABLE IF NOT EXISTS comment(
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    user VARCHAR(255) NOT NULL,
    comment TEXT NOT NULL,
    article_id VARCHAR(255) NOT NULL,
    category VARCHAR(255) NOT NULL,
    updated VARCHAR(255) NOT NULL)";

mysql_query($comment) or die(mysql_error());

//ADD A NEW COLUMN FOR ARTICLE TYPE

$add4 = "ALTER TABLE news ADD article_type VARCHAR(100)";
mysql_query($add4);

//ADD A NEW COLUMN FOR MUSIC TYPE

$add5 = "ALTER TABLE music_upload ADD music_type VARCHAR(100)";
mysql_query($add5);

//Create a table to keep comments

$subadmin = "CREATE TABLE IF NOT EXISTS subadmin(
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(500) NOT NULL,
    pass VARCHAR(500) NOT NULL)";

mysql_query($subadmin) or die(mysql_error());

//ADD A NEW COLUMN FOR AUTHOR NAME IN MUSIC

$add9 = "ALTER TABLE music_upload ADD author VARCHAR(600)";
mysql_query($add9);

//ADD A NEW COLUMN FOR AUTHOR NAME IN VIDEO

$add8 = "ALTER TABLE video_upload ADD author VARCHAR(600)";
mysql_query($add8);

//ADD A NEW COLUMN FOR AUTHOR NAME IN FILES

$add0 = "ALTER TABLE files ADD author VARCHAR(600)";
mysql_query($add0);

//ADD A NEW COLUMN FOR AUTHOR NAME IN NEWS

$addh = "ALTER TABLE news ADD author VARCHAR(600)";
mysql_query($addh);

//IMAGE 4 COLUMN

$addt = "ALTER TABLE news ADD thumb5 VARCHAR(600)";
mysql_query($addt);

//VERIFIED COLUMN

$addv = "ALTER TABLE artist ADD verify VARCHAR(600)";
mysql_query($addv);

//PREMIUM OR FREE COLUMN

$addp = "ALTER TABLE music_upload ADD premium VARCHAR(600)";
mysql_query($addp);

//VISIBLE COLUMN

$addl = "ALTER TABLE music_upload ADD visible VARCHAR(600)";
mysql_query($addl);

//Create a table for subscribed artistes

$prof = "CREATE TABLE IF NOT EXISTS artist_profile(
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(800) NOT NULL,
    username VARCHAR(800) NOT NULL,
    first VARCHAR(800) NOT NULL,
    last VARCHAR(800) NOT NULL,
    email VARCHAR(800) NOT NULL,
    phone VARCHAR(800) NOT NULL,
    password VARCHAR(800) NOT NULL,
    about TEXT NOT NULL,
    sub_status VARCHAR(800) NOT NULL)";

mysql_query($prof) or die(mysql_error());

//Create a table for subscription history

$subs = "CREATE TABLE IF NOT EXISTS sub_history(
    id INT(200) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(800) NOT NULL,
    txn_id VARCHAR(100) NOT NULL,
    txn_status VARCHAR(100) NOT NULL,
    validity VARCHAR(200) NOT NULL,
    sub_start VARCHAR(200) NOT NULL,
    sub_end VARCHAR(200) NOT NULL,
    plan VARCHAR(200) NOT NULL,
    txn_date VARCHAR(300) NOT NULL)";

mysql_query($subs) or die(mysql_error());


//PURCHASE HISTORY

$his = "CREATE TABLE IF NOT EXISTS purchase_history(
    id INT(200) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(800) NOT NULL,
    txn_id VARCHAR(100) NOT NULL,
    txn_status VARCHAR(100) NOT NULL,
    item_id VARCHAR(200) NOT NULL,
    amount VARCHAR(200) NOT NULL,
    txn_date VARCHAR(300) NOT NULL)";

mysql_query($his) or die(mysql_error());

//GIFT CARD TABLE

$gift = "CREATE TABLE IF NOT EXISTS gift(
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(40) NOT NULL,
    value INT(40) NOT NULL,
    status VARCHAR(50) NOT NULL)";

mysql_query($gift);

//USERS TABLE

$cust = "CREATE TABLE customers (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    pass VARCHAR(200) NOT NULL,
    stat VARCHAR(200) NOT NULL,
    email VARCHAR(255) NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    reg_date VARCHAR(255) NOT NULL)";

mysql_query($cust);

//PREMIUM SONGS 
$prem = "CREATE TABLE premium (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    item_id VARCHAR(100) NOT NULL,
    price VARCHAR(200) NOT NULL,
    reg_date VARCHAR(255) NOT NULL)";

mysql_query($prem);

//BALANCE TABLE FOR CREATORS
$bal = "CREATE TABLE balance (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(500) NOT NULL,
    amount VARCHAR(200) NOT NULL,
    reg_date VARCHAR(255) NOT NULL)";

mysql_query($bal);

//WITHDRAWAL TABLE FOR CREATORS
$wid = "CREATE TABLE withdraw (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(500) NOT NULL,
    amount VARCHAR(200) NOT NULL,
    name VARCHAR(800) NOT NULL,
    bank VARCHAR(400) NOT NULL,
    account VARCHAR(200) NOT NULL,
    status VARCHAR(200) NOT NULL,
    updated VARCHAR(255) NOT NULL)";

mysql_query($wid);

//BALANCE TABLE FOR CUSTOMERS
$storebal = "CREATE TABLE store_balance (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(500) NOT NULL,
    amount VARCHAR(200) NOT NULL,
    reg_date VARCHAR(255) NOT NULL)";

mysql_query($storebal);
?>