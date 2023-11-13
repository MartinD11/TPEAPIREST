Documentacion:

En esta API para poder utilizar la totalidad de sus funciones, se requiere de un token que se genera de la siguiente manera:

ingresar la siguiente url para poder generar el token:

http://localhost/TPEAPIREST/api/user/token

segundo es necesario identificarse como usuario utilizando los siguientes datos:

user:admin
password:admin

![image](https://github.com/MartinD11/TPEAPIREST/assets/137624161/f201e718-fa33-4708-8ba3-298a559d897e)

al ejecutar esta accion se generara un token el cual debera copiar e introducirlo de la siguiente manera:

opcion 1:
![image](https://github.com/MartinD11/TPEAPIREST/assets/137624161/c0b26aa3-b8f3-412c-9e7c-41ecfd71edaa)

opcion 2:
![image](https://github.com/MartinD11/TPEAPIREST/assets/137624161/10d245f5-385a-41a1-8c3b-e2ea886cf77a)

una vez hecho esto, se podra usar en su totalidad las funciones que provee esta API

GET

para obtener todos los productos se requiere la siguiente URL:

http://localhost/TPEAPIREST/api/productos

si desea obtener un unico producto, debe hacerse mediante un ID:

http://localhost/TPEAPIREST/api/productos/5

para obtener los productos ordenados por un campo y de manera ascenden o desdecente:

opciones de campos: Producto,Precio, Descripcion, Stock, Imagen, Categoria,id_producto,Gama
opciones de orden: asc/desc

ejemplo:

obtener todos los productos ordenados por Precio de manera ascendente:

http://localhost/TPEAPIREST/api/productos?sortby=Precio&order=asc

obtener todos los productos ordenados por Precio de manera descendente:

http://localhost/TPEAPIREST/api/productos?sortby=Precio&order=desc

obtener los resultados paginados:

ejemplo:

obtener de la primera pagina 5 productos:

http://localhost/TPEAPIREST/api/productos?page=1&per_page=5

obtener productos por un filtro especifico el cual es Precio en el cual te devuelve todos los productos con precio menor
a la cantidad ingresada:

http://localhost/TPEAPIREST/api/productos/filtro/precios?precio=80000

esto te devolveria los productos con el precio menor a 80000

DELETE

si desea eliminar un producto determinado debe de seguir lo siguientes pasos:

debera de tener un token para realizar esta accion(un permiso)


al ingresar este token podra ser capaz de eliminar el producto que desee de la siguiente manera:

http://localhost/TPEAPIREST/api/productos/id

asi eliminaria el producto con el id que tenga dicho producto, ejemplo:

http://localhost/TPEAPIREST/api/productos/5

POST

para crear un nuevo producto la URL sera la siguiente:

http://localhost/TPEAPIREST/api/productos

tambien sera necesario utilizar un token para poder agregar un producto

PUT

para editar un determinado producto la URL sera la siguiente:

http://localhost/TPEAPIREST/api/productos/id

tambien sera necesario utilizar un token para poder agregar un producto

CATEGORIAS

GET

para obtener todas las categorias se requiere la siguiente URL:

http://localhost/TPEAPIREST/api/categorias

si desea obtener una unica categoria, debe hacerse mediante un ID:

http://localhost/TPEAPIREST/api/categorias/2

DELETE

si desea eliminar una categoria determinada debe de seguir lo siguientes pasos:

debera de tener un token para realizar esta accion(un permiso)


al ingresar este token podra ser capaz de eliminar el producto que desee de la siguiente manera:

http://localhost/TPEAPIREST/api/categorias/id

asi eliminaria la categoria con el id que tenga dicha categoria, ejemplo:

http://localhost/TPEAPIREST/api/categorias/5

POST

para crear una nueva categoria la URL sera la siguiente:

http://localhost/TPEAPIREST/api/categorias

tambien sera necesario utilizar un token para poder agregar una categoria

PUT

para editar una determinada categoria la URL sera la siguiente:

http://localhost/TPEAPIREST/api/categoria/id

tambien sera necesario utilizar un token para poder agregar una categoria nueva

