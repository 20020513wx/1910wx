<?php
    $redis=new Redis();
    //链接redis
    $redis->connect('127.0.0.1',6379);
    var_dump($redis);

    $k1='name1';
    echo $redis->get($k1);