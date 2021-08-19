<?php
/*
*
* Veritabanı sınıfının örnek
* kullanımlarını içeren dosya
* 
*/

include 'config.php';

// 30 tane kullanıcı çeker
$users = DB::get('SELECT * FROM users LIMIT 30');

echo 'Üyelerimiz: <br/>';

foreach($users as $user)
{
	echo $user->name . '<br/>';
}

// Toplam kullanıcı sayısını çeker
$count = DB::getVar('SELECT COUNT(id) FROM users');

echo 'Toplam ' . $count . ' kullanıcımız var.';

/*
*
* Dahası için
* http://www.phpr.org/pdo-mysql-veritabani-sinifi/
*
*/