CREATE DATABASE tienda_master;
USE tienda_master;

CREATE TABLE usuarios(
    id_usuario      int(255) auto_increment not null,
    usos_nombres    varchar(100) not null,
    usos_apellidos  varchar(255),
    usos_correo     varchar(255) not null,
    usos_clave      varchar(255) not null,
    usos_imagen     varchar(255),
    rol             varchar(255),
    CONSTRAINT pk_usuario PRIMARY KEY(id_usuario),
    CONSTRAINT uq_email UNIQUE (usos_correo)
) ENGINE=InnoDb;

INSERT INTO usuarios VALUES(NULL, "admin", "admin", "admin@admin", "1234", NULL, "admin");

CREATE TABLE categorias(
    id_categoria    int(255) AUTO_INCREMENT not null,
    caia_nombre     varchar(100) not null,
    CONSTRAINT pk_categoria PRIMARY KEY(id_categoria)
) ENGINE=InnoDb;

INSERT INTO categorias VALUES(NULL, "Manga corta");
INSERT INTO categorias VALUES(NULL, "Manga larga");
INSERT INTO categorias VALUES(NULL, "Manga tirantes");
INSERT INTO categorias VALUES(NULL, "Sudadera");

CREATE TABLE productos(
    id_producto         int(255) auto_increment not null,
    categoria_id        int(255) not null,
    pros_nombre         varchar(255) not null,
    pros_descripcion    text,
    pros_precio         float(100,2) not null,
    pros_stock          int(255) not null,
    pros_oferta         varchar(2),
    pros_fecha          date not null,
    pros_imagen         varchar(255),
    CONSTRAINT pk_producto PRIMARY KEY(id_producto),
    CONSTRAINT fk_producto_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id_categoria)
)ENGINE=InnoDb;

CREATE TABLE pedidos(
    id_pedido               int(255) auto_increment not null,
    usuario_id              int(255) not null,
    peos_direccion          varchar(255) not null,
    peos_localidad          varchar(255) not null,
    peos_provincia          varchar(255) not null,
    peos_costo              float(255,2) not null,
    peos_estado             varchar(20) not null,
    peos_fecha              date not null,
    peos_hora               time,
    CONSTRAINT pk_pedido PRIMARY KEY(id_pedido),
    CONSTRAINT fk_pedido_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id_usuario)
)ENGINE=InnoDb;

CREATE TABLE lineasPedidos(
    id_lineasPedido         int(255) auto_increment not null,
    pedido_id               int(255) not null,
    producto_id             int(255) not null,
    lios_cantidad           int(255) not null,
    CONSTRAINT pk_lineasPedido PRIMARY KEY(id_lineasPedido),
    CONSTRAINT fk_lineasPedido_pedido FOREIGN KEY(pedido_id) REFERENCES pedidos(id_pedido),
    CONSTRAINT fk_lineasPedido_producto FOREIGN KEY(producto_id) REFERENCES productos(id_producto)
)ENGINE=InnoDb;