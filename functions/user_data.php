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
        $this->usuario = $user['usuario'];
        $this->password = $user['password'];
        $this->nombre = $user['nombre'];
        $this->apellidos = $user['apellidos'];
        $this->email = $user['email'];
        $this->baja = $user['baja'];
        $this->ultimo_usuario = $user['ultimo_usuario'];
    }
}
?>