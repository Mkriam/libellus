USE libellus;
set names 'utf8mb4';

-- Usuarios
INSERT INTO USUARIO (nom_usu, email, clave_usu, foto_perfil, administrador) VALUES
('lector1', 'lector1@example.com', 'clave123', NULL, 1),
('fan_hp', 'harrypotterfan@mail.net', 'potterhead', NULL, 0),
('amantedelamisterio', 'misterios@detective.org', 'pistas789', NULL, 0);

-- Géneros
INSERT INTO GENERO(nom_genero) VALUES
('Fantasía'), ('Ciencia Ficción'), ('Misterio'), ('Romance'), ('Drama'), ('Aventura'), ('Comedia'), ('Terror'), ('Thriller'), ('Histórico'), ('Poesía'), ('Ensayo'), ('Biografía'), ('Autobiografía');

-- Autores
INSERT INTO AUTOR(nom_autor) VALUES
('J.K. Rowling'), ('Agatha Christie'), ('Harper Lee'), ('Suzanne Collins'), ('Paulo Coelho'), ('Gabriel García Márquez'), ('George Orwell'), ('F. Scott Fitzgerald'), ('Fiódor Dostoievski'), ('Frank Herbert'), ('Miguel de Cervantes'), ('Jane Austen');

-- Libros
INSERT INTO LIBRO(titulo, portada, sinopsis, fec_publicacion, url_compra) VALUES
('Harry Potter y la piedra filosofal', NULL, 'El día en que cumple once años, Harry Potter descubre que es hijo de dos conocidos hechiceros, de los que ha heredado poderes mágicos. Deberá acudir entonces a una famosa escuela de magia y hechicería: Howards.', '1997-06-26', 'https://www.casadellibro.com/libro-harry-potter-y-la-piedra-filosofal-rustica/9788498386318/2428061'),
('Harry Potter y la cámara secreta', NULL, 'Hay una conspiración, Harry Potter. Una conspiración para hacer que este año sucedan las cosas más terribles en el Colegio Hogwarts de Magia y Hechicería..', '2015-03-26', 'https://www.casadellibro.com/libro-harry-potter-y-la-camara-secreta--rustica/9788498386325/2428062'),
('Harry Potter y el prisionero de Azkaban', NULL, 'Cuando el autobús noctámbulo irrumpe en una calle oscura y frena con fuertes chirridos delante de Harry, comienza para él un nuevo curso en Hogwarts, lleno de acontecimientos extraordinarios.', '2015-03-26', 'https://www.casadellibro.com/libro-harry-potter-y-el-prisionero-de-azkaban-rustica/9788498386332/2506473'),
('Harry Potter y el caliz de fuego', NULL, 'Se va a celebrar en Hogwarts el Torneo de los Tres Magos. Sólo los alumnos mayores de diecisiete años pueden participar en esta competición, pero, aun así, Harry sueña con ganarla.', '2015-03-26', 'https://www.casadellibro.com/libro-harry-potter-y-la-camara-secreta--rustica/9788498386325/2428062'),
('Harry Potter y la orden del fenix', NULL, 'Son malos tiempos para Hogwarts. Tras el ataque de los dementores a su primo Dudley, Harry Potter comprende que Voldemort no se detendrá ante nada para encontrarlo.', '2015-03-26', 'https://www.casadellibro.com/libro-harry-potter-y-la-orden-del-fenix-rustica/9788498386356/2506476'),
('Harry Potter y el misterio del príncipe', NULL, 'Con dieciseis años cumplidos, Harry inicia el sexto curso en Hogwarts en medio de terribles acontecimientos que asolan Inglaterra.', '2015-03-26', 'https://www.casadellibro.com/libro-harry-potter-y-el-misterio-del-principe-rustica/9788498386363/2532591'),
('Harry Potter y las reliquias de la muerte', NULL, 'Cuando se monta en el sidecar de la moto de Hagrid y se eleva en el cielo, dejando Privet Drive por última vez, Harry Potter sabe que lord Voldemort y sus mortífagos se hallan cerca.', '2015-03-26', 'https://www.casadellibro.com/libro-harry-potter-y-las-reliquias-de-la-muerte-rustica/9788498386370/2532593'),
('El alquimista', NULL, 'Cuando quieres algo, todo el Universo conspira para ayudarte a conseguirlo. Una fábula inspiradora sobre la importancia de luchar por tus sueños.', '1988-04-01', 'https://www.casadellibro.com/libro-el-alquimista/9788408304555/16834038'),
('Cien años de soledad', NULL, 'Muchos años después, frente al pelotón de fusilamiento, el coronel Aureliano Buendía había de recordar aquella tarde remota en que su padre lo llevó a conocer el hielo.', '1967-05-30', 'https://www.casadellibro.com/libro-cien-anos-de-soledad/9788466379717/16422540'),
('1984', NULL, 'En 1984, los ciudadanos de Londres ya no distinguen entre el aspecto privado y público de sus vidas.', '1949-06-08', 'https://www.casadellibro.com/libro-1984/9788445010273/12339998'),
('Orgullo y prejuicio', NULL, 'Con la llegada del rico y apuesto señor Darcy a su región, la vida de los Bennet y sus cinco hijas se vuelve del revés.', '1813-01-28', 'https://www.casadellibro.com/libro-orgullo-y-prejuicio/9788467077834/16834296'),
('Crimen y castigo', NULL, 'Nadie ha retratado la psicología humana como lo hizo Fiódor Dostoyevski. Su obra, fiel reflejo de una personalidad compleja y atormentada, marca una de las cimas de la narrativa universal.', '1866-01-15', 'https://www.casadellibro.com/libro-crimen-y-castigo/9788418008122/11751229'),
('El gran Gatsby', NULL, 'Historia de amor, ambición y tragedia en los años 20 en EE.UU.', '1925-04-10', 'https://www.casadellibro.com/libro-el-gran-gatsby/9788433976963/1997923'),
('Don Quijote de la Mancha', NULL, 'La legendaria novela de Miguel de Cervantes sobre un caballero loco y su escudero.', '1605-01-16', 'https://www.casadellibro.com/libro-don-quijote-de-la-mancha--edicion-conmemorativa/9788491057536/16611648'),
('Matar a un ruiseñor', NULL, 'Disparad a todos los arrendajos azules que queráis, si podéis acertarles, pero recordad que es un pecado matar a un ruiseñor.', '1960-07-11', 'https://www.casadellibro.com/libro-matar-a-un-ruisenor/9788417216948/12040951'),
('Los juegos del hambre', NULL, 'El mundo está observando. Ganar significa fama y riqueza. Perder significa una muerte segura.¡Que empiecen los septuagesimo cuartos juegos del hambre!', '2008-09-14', 'https://www.casadellibro.com/libro-los-juegos-del-hambre-1---los-juegos-del-hambre-edicion-especial-/9788427248465/16444078'),
('Dune', NULL, 'Arrakis: un planeta desertico donde el agua es el bien más preciado y, donde llorar a los muertos es el símbolo de máxima prodigalidad.', '1965-08-01', 'https://www.casadellibro.com/libro-dune-las-cronicas-de-dune-1/9788466363402/13577796'),
('Asesinato en el Orient Express', NULL, 'Un misterio en un tren.', '1934-01-01', 'https://www.amazon.es/Asesinato-Orient-Express-Espasa-Narrativa/dp/8467045418/ref=sr_1_1?dib=eyJ2IjoiMSJ9.TgZERJFjstx1d73L07Tzgzog9_hRa3a-moQ54mNVPxbUrthxCWyShzem00-xmxMLYlTnZR0nULNfqoVdWJencexQZ66uIIzawcPgfCZ2mWlughxYS1npgooYRkyzlc5ZdYGPNHwqFY0czilimpNo-fRWIkc-kcEDskJ0DOPUvVsGhUWjfE25IZm6ejvq6RbHQ9xl0NPTl6TdTdVdWubQ1E1B4I8nMts7pH-Vob8K_T4.iPvSCp-r1cg8U29mL6TdJz_R8ZGCYWHRwUt858QcBIg&dib_tag=se&keywords=asesinato+en+el+orient+express+agatha+christie&qid=1744561229&s=books&sr=1-1');

-- Posee
INSERT INTO POSEE (id_libro, id_genero) VALUES
(1, 1), -- Harry Potter y la piedra filosofal - Fantasía
(2, 1), -- Harry Potter y la cámara secreta - Fantasía
(3, 1), -- Harry Potter y el prisionero de Azkaban - Fantasía
(4, 1), -- Harry Potter y el caliz de fuego - Fantasía
(5, 1), -- Harry Potter y la orden del fenix - Fantasía
(6, 1), -- Harry Potter y el misterio del príncipe - Fantasía
(7, 1), -- Harry Potter y las reliquias de la muerte - Fantasía
(8, 1), -- El alquimista - Fantasía 
(9, 2), -- Cien años de soledad - Ciencia Ficción
(10, 2), -- 1984 - Ciencia Ficción
(11, 4), -- Orgullo y prejuicio - Romance
(12, 3), -- Crimen y castigo - Misterio
(12, 5), -- Crimen y castigo - Drama
(13, 4), -- El gran Gatsby - Drama
(14, 6), -- Don Quijote de la Mancha - Aventura
(14, 7), -- Don Quijote de la Mancha - Comedia
(15, 5), -- Matar a un ruiseñor - Drama
(16, 2), -- Los juegos del hambre - Ciencia Ficción
(16, 6), -- Los juegos del hambre - Aventura
(17, 2), -- Dune - Ciencia Ficción 
(17, 6), -- Dune - Aventura
(18, 3); -- Asesinato en el Orient Express - Misterio

-- Escribe
INSERT INTO ESCRIBE (id_libro, id_autor) VALUES
(1, 1), -- Harry Potter y la piedra filosofal - J.K. Rowling
(2, 1), -- Harry Potter y la cámara secreta - J.K. Rowling
(3, 1), -- Harry Potter y el prisionero de Azkaban - J.K. Rowling
(4, 1), -- Harry Potter y el caliz de fuego - J.K. Rowling
(5, 1), -- Harry Potter y la orden del fenix - J.K. Rowling
(6, 1), -- Harry Potter y el misterio del príncipe - J.K. Rowling
(7, 1), -- Harry Potter y las reliquias de la muerte - J.K. Rowling
(8, 5), -- El alquimista - Paulo Coelho
(9, 6), -- Cien años de soledad - Gabriel García Márquez
(10, 7), -- 1984 - George Orwell
(11, 12), -- Orgullo y prejuicio - Jane Austen
(12, 9), -- Crimen y castigo - Fiódor Dostoievski
(13, 8), -- El gran Gatsby - F. Scott Fitzgerald
(14, 11), -- Don Quijote de la Mancha - Miguel de Cervantes
(15, 3), -- Matar a un ruiseñor - Harper Lee
(16, 4), -- Los juegos del hambre - Suzanne Collins
(17, 10), -- Dune - Frank Herbert
(18, 2); -- Asesinato en el Orient Express - Agatha Christie

-- Grupos
INSERT INTO GRUPO (nom_grupo, clave_grupo, descripcion, id_lider) VALUES
('Amantes de Harry Potter', 'magia2025', 'Grupo para discutir los libros de Harry Potter.', 'fan_hp'),
('Club de Lectura de Misterio', 'enigmasCl', 'Leemos y comentamos novelas de misterio y suspense.', 'amantedelamisterio');

-- Pertenece
INSERT INTO PERTENECE (nom_usu, id_grupo, fec_union) VALUES
('lector1', 1, '2025-04-01'),
('fan_hp', 2, '2025-03-15'),
('amantedelamisterio', 2, '2025-03-20'),
('amantedelamisterio', 1, '2025-04-10');

-- Contiene
INSERT INTO CONTIENE (id_grupo, id_libro, fecha) VALUES
(1, 1, '2025-03-16'),
(1, 2, '2025-03-23'),
(2, 18, '2025-03-25'),
(2, 12, '2025-04-08');

-- Guarda
INSERT INTO GUARDA (nom_usu, id_libro, comentario, estado) VALUES
('lector1', 9, 'Un clásico imprescindible.', 'Pendiente'),
('lector1', 14, 'Me encantó la edición.', 'Pendiente'),
('fan_hp', 1, 'El inicio de una gran saga.', 'Pendiente'),
('fan_hp', 3, 'Mi libro favorito de la serie.', 'Leyendo'),
('amantedelamisterio', 18, 'Un final sorprendente.', 'Pendiente'),
('amantedelamisterio', 12, 'Intriga desde la primera página.', 'Leyendo');
