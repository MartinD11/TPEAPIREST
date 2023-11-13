<?php
require_once 'config.php';
class Model {
    protected $db;
    function __construct() {
        $this->db = new PDO('mysql:host='. MYSQL_HOST .';dbname='. MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);
        $this->deploy();
    }

    function deploy(){
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll(); //devuelve las tablas de la db
        $aux= '$n0D';
        if(count($tables)==0){
            $sql =<<<END
            
                    -- Table structure for table `categorias`
                    --

                    CREATE TABLE `categorias` (
                    `id_categorias` int(11) NOT NULL,
                    `Categoria` varchar(45) NOT NULL,
                    `Gama` varchar(45) NOT NULL
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                    --
                    -- Dumping data for table `categorias`
                    --

                    INSERT INTO `categorias` (`id_categorias`, `Categoria`, `Gama`) VALUES
                    (1, 'motherboard', 'gamaalta'),
                    (2, 'procesador', 'gamaalta'),
                    (3, 'placa de video', 'alta'),
                    (6, 'cooler', 'gamaalta');

                    -- --------------------------------------------------------

                    --
                    -- Table structure for table `productos`
                    --

                    CREATE TABLE `productos` (
                    `id_producto` int(11) NOT NULL,
                    `Producto` varchar(45) NOT NULL,
                    `Precio` float NOT NULL,
                    `Descripcion` varchar(200) NOT NULL,
                    `Stock` tinyint(1) DEFAULT 1,
                    `Imagen` varchar(250) NOT NULL,
                    `Marcas` varchar(50) NOT NULL,
                    `id_categorias` int(11) NOT NULL
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                    --
                    -- Dumping data for table `productos`
                    --

                    INSERT INTO `productos` (`id_producto`, `Producto`, `Precio`, `Descripcion`, `Stock`, `Imagen`, `Marcas`, `id_categorias`) VALUES
                    (23, 'Procesador AMD RYZEN 3 3200G ', 84900, '4.0GHz Turbo + Radeon Vega 8 AM4 Wraith Stealth Cooler', 1, './images/amdryzen3200g.jpg', 'amd', 2),
                    (24, 'motherboard b550', 84574, 'nueva mother amd con nuevo chiupset', 1, './images/compragamer_Imganen_general_35857_Mother_MSI_A320M-A_PRO_AM4_1ef3e050-grn.jpg', 'msi', 1),
                    (31, 'Mother ASUS ROG STRIX B550-F GAMING WIFI II', 245650, 'Socket AM4 APU 3th Gen,AM4 APU 5000,AM4 Ryzen 3th Gen,AM4', 1, './images/compragamer_Imganen_general_32296_Mother_ASUS_ROG_STRIX_B550-F_GAMING_WIFI_II_d770a43e-grn.jpg', 'ASUS', 1),
                    (32, 'Placa de Video MSI GeForce RTX 3070 8GB GDDR6', 568600, 'GDDR6 GAMING X TRIO', 1, './images/compragamer_Imganen_general_35044_Placa_de_Video_MSI_GeForce_RTX_3070_8GB_GDDR6_GAMING_X_TRIO_d87dd4ab-grn.jpg', 'MSI', 3),
                    (33, 'Cooler CPU Cooler Master Hyper', 23500, 'Cooler CPU Cooler Master Hyper 212 Spectrum V2 ', 1, './images/compragamer_Imganen_general_33472_Cooler_CPU_Cooler_Master_Hyper_212_Spectrum_V2_b367fcda-grn.jpg', 'Cooler Master', 6);

                    -- --------------------------------------------------------

                    --
                    -- Table structure for table `usuarios`
                    --

                    CREATE TABLE `usuarios` (
                    `id_usuario` int(11) NOT NULL,
                    `User` varchar(80) NOT NULL,
                    `Password` varchar(250) NOT NULL
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                    --
                    -- Dumping data for table `usuarios`
                    --

                    INSERT INTO `usuarios` (`id_usuario`, `User`, `Password`) VALUES
                    (1, 'admin', '$2y$10$aux.dUcjJaSZYCkdniqt9.BdoUosl72UOKjs.r23bkqaB9kI2QMzy');

                    --
                    -- Indexes for dumped tables
                    --

                    --
                    -- Indexes for table `categorias`
                    --
                    ALTER TABLE `categorias`
                    ADD PRIMARY KEY (`id_categorias`);

                    --
                    -- Indexes for table `productos`
                    --
                    ALTER TABLE `productos`
                    ADD PRIMARY KEY (`id_producto`),
                    ADD KEY `fk_Productos_Categorias` (`id_categorias`);

                    --
                    -- Indexes for table `usuarios`
                    --
                    ALTER TABLE `usuarios`
                    ADD PRIMARY KEY (`id_usuario`);

                    --
                    -- AUTO_INCREMENT for dumped tables
                    --

                    --
                    -- AUTO_INCREMENT for table `categorias`
                    --
                    ALTER TABLE `categorias`
                    MODIFY `id_categorias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

                    --
                    -- AUTO_INCREMENT for table `productos`
                    --
                    ALTER TABLE `productos`
                    MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

                    --
                    -- AUTO_INCREMENT for table `usuarios`
                    --
                    ALTER TABLE `usuarios`
                    MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

                    --
                    -- Constraints for dumped tables
                    --

                    --
                    -- Constraints for table `productos`
                    --
                    ALTER TABLE `productos`
                    ADD CONSTRAINT `fk_Productos_Categorias` FOREIGN KEY (`id_categorias`) REFERENCES `categorias` (`id_categorias`) ON UPDATE CASCADE;
                    COMMIT;
            END;
            $this->db->query($sql);
        }
    }
}