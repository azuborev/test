<?php
$string1 = 'abcde^%ddfd !!ngfjgjfdg )dfdfg]';
$pattern1 = '/[^\w\s]/'; // '/[^a-zA-Z0-9\s]/'
$valid_string1 = preg_replace($pattern1, '', $string1);
echo $valid_string1."\n";

$string2 = 'fndsghjdfbg dfgndfgndjfgdfg jngfd test@test.com gfdgndfjgndf test1@test.com zuborev.kh@gmail.com azuborev@corp.web4pro.com.ua
            a.n.zuborev@gmail.com w.zuborev@mail.ru w.zubo-rev@mail.ru';
$pattern2 = '/[\w.\-]+@\w+(\.\w{2,})+/';
preg_match_all($pattern2, $string2, $matches);
print_r($matches[0]);