<?php
class user_data {
    public int $id_usuario;
    public string $usuario;
    public string $passwd;
    public string $nombre;
    public string $apellidos;
    public string $email;
    public string $telefono;
    public ?string $ofertante;

    public function __construct(array $user) {
        $this->id_usuario = $user['id_usuario'];
        $this->usuario = $user['usuario'];
        $this->passwd = $user['passwd'];
        $this->nombre = $user['nombre'];
        $this->apellidos = $user['apellidos'];
        $this->email = $user['email'];
        $this->telefono = $user['telefono'];
        $this->ofertante = isset($user['ofertante'])?1:0;
    }
}
?>