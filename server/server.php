<?php
error_reporting(1);
header('Content-Type: text/xml; charset=UTF-8');

include "Database.php";
$abc = new Database();

function filter($data)
{
    $data = preg_replace('/[^a-zA-Z0-9]/', '', $data);
    return $data;
    unset($data);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = file_get_contents('php://input');
    $data = xmlrpc_decode($input);
    $aksi = $data[0]['aksi'];
    $id = $data[0]['id'];
    $nama = $data[0]['nama'];
    $stok = $data[0]['stok'];
    $satuan = $data[0]['satuan'];

    if ($aksi == 'tambah') {
        $data2 =
            array(
                'id' => $id,
                'nama' => $nama,
                'stok' => $stok,
                'satuan' => $satuan
            );
        $abc->tambah_data($data2);
    } else if ($aksi == 'ubah') {
        $data2 =
            array(
                'id' => $id,
                'nama' => $nama,
                'stok' => $stok,
                'satuan' => $satuan
            );
        $abc->ubah_data($data2);
    } else if ($aksi == 'hapus') {
        $abc->hapus_data($id);
    }
    unset($input, $data, $data2, $id, $nama, $stok, $satuan, $aksi);
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (($_GET['aksi'] == 'tampil') and (isset($_GET['id']))) {
        $id = filter($_GET['id']);
        $data = $abc->tampil_data($id);
        $xml = xmlrpc_encode($data);
        echo $xml;
    } else {
        $data = $abc->tampil_semua_data();
        $xml = xmlrpc_encode($data);
        echo $xml;
    }
    unset($xml, $query, $id, $data);
}
