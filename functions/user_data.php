<?php
class user_data {
    public ?int $id;
    public string $usuario;
    public string $password;
    public string $nombre;
    public string $apellidos;
    public string $email;
    public string $baja;
    public string $ultimo_usuario;
    
    public function __construct(array $user = ['id' => null, 'usuario' => 'usuario', 'password' => '12345','nombre' => 'nombre', 'apellidos' => 'apellidos', 'email' => 'email', 'baja' => 0, 'ultimo_usuario' => 'admin']) {
        $this->id = $user['id'];
        $this->usuario = substr($user['usuario'], 0, 30);
        $this->password = substr($user['password'], 0, 50);
        $this->nombre = substr($user['nombre'], 0, 50);
        $this->apellidos = substr($user['apellidos'], 0, 150);
        $this->email = substr($user['email'], 0, 320);
        $this->baja = $user['baja'];
        $this->ultimo_usuario = $user['ultimo_usuario'];
    }
}
?>