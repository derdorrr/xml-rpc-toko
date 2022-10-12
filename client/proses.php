<?php
include "RPCClient.php";

if ($_POST['aksi'] == 'tambah') // tambah data
{
	$data = xmlrpc_encode_request("method", array(
		"aksi" => $_POST['aksi'],
		"id" => $_POST['id'],
		"nama" => $_POST['nama'],
		"stok" => $_POST['stok'],
		"satuan" => $_POST['satuan']

	));
	$context = stream_context_create(array('http' => array(
		'method' => "POST",
		'header' => "Content-Type:text/xml;charset=UTF-8",
		'content' => $data
	)));
	$file = file_get_contents($url, false, $context);
	xmlrpc_decode($file);
	header('location:index.php?page=daftar-data');
	// hapus variable dari memory
	unset($data, $context, $url, $response);
} else if ($_POST['aksi'] == 'ubah') // ubah data
{
	$data = xmlrpc_encode_request("method", array(
		"aksi" => $_POST['aksi'],
		"id" => $_POST['id'],
		"nama" => $_POST['nama'],
		"stok" => $_POST['stok'],
		"satuan" => $_POST['satuan'],
	));
	$context = stream_context_create(array('http' => array(
		'method' => "POST",
		'header' => "Content-Type:text/xml;charset=UTF-8",
		'content' => $data
	)));
	$file = file_get_contents($url, false, $context);
	xmlrpc_decode($file);
	header('location:index.php?page=daftar-data');

	unset($data, $context, $url, $response);
} else if ($_GET['aksi'] == 'hapus') // hapus data	
{
	$data = xmlrpc_encode_request("method", array(
		"aksi" => $_GET['aksi'],
		"id" => $_GET['id']
	));
	$context = stream_context_create(array('http' => array(
		'method' => "POST",
		'header' => "Content-Type:text/xml;charset=UTF-8",
		'content' => $data
	)));
	$file = file_get_contents($url, false, $context);
	xmlrpc_decode($file);
	header('location:index.php?page=daftar-data');
	unset($data, $context, $url);
}
