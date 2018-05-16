$app->post('/addJsonLogin/', function (Request $request, Response $response){
    $login = $request->getParsedBody();
    $sql = "INSERT INTO login (ID, nama, username, password) VALUE ('', :nama, :username, :password)";
    $stmt = $this->db->prepare($sql);
    $data = [
        ":nama" => $login["nama"],
        ":username" => $login["username"],
        ":password" => $login["password"]
    ];
    if($stmt->execute($data)){
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    }
    else{
        return $response->withJson(["status" => "failed", "data" => "0"], 200);
    }
   
});
$app->post('/addJsonPaslon/', function (Request $request, Response $response){
    $paslon = $request->getParsedBody();
    $sql = "INSERT INTO paslon (ID, no_urut, nama, tempat_lahir, tgl_lahir, jk, pendidikan, jejak_rekam, jabatan, foto) 
    VALUE ('', :no_urut, :nama, :tempat_lahir, :tgl_lahir, :jk, :pendidikan, :jejak_rekam, :jabatan, :foto)";
    $stmt = $this->db->prepare($sql);
    $data = [
        ":no_urut" => $paslon["no_urut"],
        ":nama" => $paslon["nama"],
        ":tempat_lahir" => $paslon["tempat_lahir"],
        ":tgl_lahir" => $paslon["tgl_lahir"],
        ":jk" => $paslon["jk"],
        ":pendidikan" => $paslon["pendidikan"],
        ":jejak_rekam" => $paslon["jejak_rekam"],
        ":jabatan" => $paslon["jabatan"],
        ":foto" => $paslon["foto"]
    ];
    if($stmt->execute($data)){
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    }
    else{
        return $response->withJson(["status" => "failed", "data" => "0"], 200);
    }
   
});
$app->post('/berita/', function (Request $request, Response $response){
    $berita = $request->getParsedBody();
    $sql = "INSERT INTO berita (ID, tanggal, judul, isi, foto) VALUE 
    ('', :tanggal, :judul, :isi, :foto)";
    $stmt = $this->db->prepare($sql);
    $data = [
        ":tanggal" => $berita["tanggal"],
        ":judul" => $berita["judul"],
        ":isi" => $berita["isi"],
        ":foto" => $berita["foto"]
    ];
    if($stmt->execute($data)){
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    }
    else{
        return $response->withJson(["status" => "failed", "data" => "0"], 200);
    }
   
});
//add data
$app->post('/addLogin/', function (Request $request, Response $response){
    $login = $request->getParsedBody();
    $sql = "INSERT INTO login (ID, nama, username, password) VALUE ('', :nama, :username, :password)";
    $stmt = $this->db->prepare($sql);
    $data = [
        ":nama" => $login["nama"],
        ":username" => $login["username"],
        ":password" => $login["password"]
    ];
    if($stmt->execute($data)){
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    }
    else{
        return $response->withJson(["status" => "failed", "data" => "0"], 200);
    }
});

$app->post('/berita/', function (Request $request, Response $response){
    $countdown = $request->getParsedBody();
   
});
$app->post('/countdown/', function (Request $request, Response $response){
    $countdown = $request->getParsedBody();
   
});
$app->post('/lapor/', function (Request $request, Response $response){
    $lapor = $request->getParsedBody();   
});
$app->post('/tahapan/', function (Request $request, Response $response){
    $tahapan = $request->getParsedBody();
   
});
$app->post('/visi/', function (Request $request, Response $response){
    $visi = $request->getParsedBody();  
});


//get page
$app->get('/login/', function (Request $request, Response $response){
    $response = $this->view->render($response, 'login.php');
    return $response;
});
$app->get('/home/', function (Request $request, Response $response){
    $response = $this->view->render($response, 'index.php');
    return $response;
});
$app->get('/profil/', function(Request $request, Response $response){
    $response = $this->view->render($response, 'paslon.php');
    return $response;
});
$app->get('/visi/', function(Request $request, Response $response){
    $response = $this->view->render($response, 'visi.php');
    return $response;
});
$app->get('/tahapan/', function(Request $request, Response $response){
    $response = $this->view->render($response, 'tahapan.php');
    return $response;
});
$app->get('/berita/', function(Request $request, Response $response){
    $response = $this->view->render($response, 'berita.php');
    return $response;
});



 //get one data
$app->post('/loginAction/', function (Request $request, Response $response){
    $loginaksi = $request->getParsedBody();
    $sql = "select * from login where username= :username and password= :password";
    $stmt = $this->db->prepare($sql);
    $data = [
        ":username" => $loginaksi["username"],
        ":password" => $loginaksi["password"]
    ];
    $stmt->execute($data);
    $result = $stmt->fetchAll();
    $hasilCount = count($result);
    if($hasilCount > 0){
        return $response->withRedirect('/slim_kpu2/public/index.php/home/');
    }
    else{
        return "false username/password";
    }
});

/*$app->get('/login/', function (Request $request, Response $response){
    $sql = "SELECT * FROM login";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});*/