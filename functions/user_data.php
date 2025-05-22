<?php
class user_data {
    public int $id_usuario;
    public string $usuario;
    public string $passwd;
    public string $nombre;
    public string $apellidos;
    public string $email;

    public function __construct(array $user = ['id_usuario' => '1', 'usuario' => 'usuario', 'passwd' => '12345','nombre' => 'nombre', 'apellidos' => 'apellidos', 'email' => 'email',]) {
        $this->id_usuario = $user['id_usuario'];
        $this->usuario = $user['usuario'];
        $this->passwd = $user['passwd'];
        $this->nombre = $user['nombre'];
        $this->apellidos = $user['apellidos'];
        $this->email = $user['email'];
    }
}
?>