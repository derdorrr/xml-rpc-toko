<?php
error_reporting(1);

class Database
{
    private $host = "192.168.55.74";
    private $dbname = "toko";
    private $user = "deri";
    private $password = "fauzi";
    private $port = "3306";
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->dbname;charset=utf8", $this->user, $this->password);
        } catch (PDOException $e) {
            echo "Koneksi Gagal";
        }
    }

    public function tampil_data($id)
    {
        $query = $this->conn->prepare("select id,nama,stok,satuan from barang where id=?");
        $query->execute(array($id));
        $data = $query->fetch(PDO::FETCH_ASSOC);
        return $data;
        $query->closeCursor();
        unset($id, $data);
    }

    public function tampil_semua_data()
    {
        $query = $this->conn->prepare("select id, nama, stok, satuan from barang order by id");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        $query->closeCursor();
        unset($data);
    }

    public function tambah_data($data)
    {
        $query = $this->conn->prepare("insert ignore into barang (id,nama,stok,satuan) values (?,?,?,?)");
        $query->execute(array($data['id'], $data['nama'], $data['stok'], $data['satuan']));
        $query->closeCursor();
        unset($data);
    }

    public function ubah_data($data)
    {
        $query = $this->conn->prepare("update barang set nama=?,stok=?,satuan=? where id=?");
        $query->execute(array($data['nama'], $data['stok'], $data['satuan'], $data['id']));
        $query->closeCursor();
        unset($data);
    }

    public function hapus_data($id)
    {
        $query = $this->conn->prepare("delete from barang where id=?");
        $query->execute(array($id));
        $query->closeCursor();
        unset($id);
    }
}
