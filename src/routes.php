<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
//user route
$app->post('/addUser/', function (Request $request, Response $response){
    $user = $request->getParsedBody();
    $sql = "INSERT INTO user (NIM, nama, password, role) VALUE (:NIM, :nama, :password, :role)";
    $stmt = $this->db->prepare($sql);
    $data = [
        ":nama" => $user["nama"],
        ":NIM" => $user["NIM"],
        ":password" => $user["password"],
        ":role" => "user"
    ];
    if($stmt->execute($data)){
        $stmt->execute($data);
        $result = $stmt->fetchAll();
        return $response->withJson(["status" => "success", "data" => $result], 200);
    }
    else{
        return $response->withJson(["status" => "failed", "data" => "0"], 200);
    }   
});

$app->post('/loginUser/', function (Request $request, Response $response){
    $login = $request->getParsedBody();
    $sql = "SELECT * FROM user where NIM=:NIM and password=:password and role=:role";
    $stmt = $this->db->prepare($sql);
    $data = [
        ":NIM" => $login["NIM"],
        ":password" => $login["password"],
        ":role" => "user"
    ];
    $stmt->execute($data);
    $count = count($stmt);
    if($count > 0){
        return $response->withJson(["status" => "success", "login" => "1"], 200);
    }
    else{
        return $response->withJson(["status" => "login_failed", "data" => "0"], 200);
    }
});

$app->post('/addPengaduan/', function (Request $request, Response $response){
    $pengaduan = $request->getParsedBody();
    $sql = "INSERT INTO user (ID, judul, NIM, keluhan, saran, jenis_keluhan, foto) VALUE ('', :judul, :NIM, :keluhan, :saran, :jenis_keluhan, :foto)";
    $stmt = $this->db->prepare($sql);
    $data = [
        ":judul" => $pengaduan["judul"],
        ":NIM" => $pengaduan["NIM"],
        ":keluhan" => $pengaduan["keluhan"],
        ":saran" => $pengaduan["saran"],
        ":jenis_keluhan" => $pengaduan["jenis_keluhan"],
        ":foto" => $pengaduan["foto"]
    ];
    if($stmt->execute($data)){
        $stmt->execute($data);
        $result = $stmt->fetchAll();
        return $response->withJson(["status" => "success", "data" => $result], 200);
    }
    else{
        return $response->withJson(["status" => "failed", "data" => "0"], 200);
    }   
});

$app->get('/getPengaduan/{NIM}', function (Request $request, Response $response, $args){
	$id = $args['NIM'];
	$sql = "SELECT * FROM data_pengaduan where NIM = :NIM";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(["NIM" => $id]);
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

$app->get('/getAllDosen/', function (Request $request, Response $response){
    $sql = "SELECT * FROM dosen";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

$app->get('/getDosen/{NIK}', function(Request $request, Response $response, $args){
    $id = $args['NIK'];
    $sql = "SELECT * FROM dosen where NIK = :NIK";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(["NIK" => $id]);
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

//admin route

$app->post('/loginAdmin/', function (Request $request, Response $response){
    $login = $request->getParsedBody();
    $sql = "SELECT * FROM where NIM=:NIM and password=:password and role=:role";
    $stmt = $this->db->prepare($sql);
    $data = [
        ":NIM" => $login["NIM"],
        ":password" => $login["password"],
        ":role" => "admin"
    ];
    $stmt->execute($data);
    $count = count($stmt);
    if($count > 0){
        return $response->withJson(["status" => "success", "data" => "1"], 200);
    }
    else{
        return $response->withJson(["status" => "login_failed", "data" => "0"], 200);
    }
});

$app->get('/getPengaduanAdmin/{param}', function(Request $request, Response $response, $args){
    $param = $args['param'];
    $sql = "SELECT * FROM data_pengaduan where jenis_keluhan = :parameter";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(["parameter" => $param]);
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

$app->post('/addDosen/', function(Request $request, Response $response){
    $dosen = $request->getParsedBody();
    $sql = "INSERT INTO dosen (NIK, nama, kontak, alamat, foto) VALUE (:NIK, :nama, :kontak, :alamat, :foto)";
    $stmt = $this->db->prepare($sql);
    $data = [
        ":NIK" => $dosen["NIK"],
        ":nama" => $dosen["nama"],
        ":kontak" => $dosen["kontak"],
        ":alamat" => $dosen["alamat"],
        ":foto" => $dosen["foto"]
    ];
    if($stmt->execute($data)){
        $stmt->execute($data);
        $result = $stmt->fetchAll();
        return $response->withJson(["status" => "success", "data" => $result], 200);
    }
    else{
        return $response->withJson(["status" => "failed", "data" => "0"], 200);
    }   
});

$app->get('/getStatistik/', function(Request $request, Response $response){
    $sql = "SELECT jml_administrasi, jml_fasilitas, jml_dosen, jml_organisasi FROM jml_organisasi, jml_fasilitas, jml_dosen, jml_administrasi";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

$app->get('/deleteStatistik/', function(Request $request, Response $response){
    
});

$app->post('/updatePassword/', function(Request $request, Response $response){
    $update = $request->getParsedBody();
    $sql = "UPDATE user set password=:password where NIM=:NIM";
    $stmt = $this->db->prepare($sql);
    $data = [
        ":NIM" => $update["NIM"],
        ":password" => $update["password"]
    ];
    $stmt->execute($data);
    return $response->withJson(["status" => "data has been updated"], 200);
});

$app->get('/getPassword/{NIM}', function(Request $request, Response $response, $args){
    $id = $args['NIM'];
    $sql = "SELECT password from user where NIM=:NIM";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(["NIM" => $id]);
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});