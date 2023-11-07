    <?php
    require_once 'app/controllers/api.controller.php';
    require_once 'app/helpers/auth.api.helper.php';
    require_once 'app/models/user.model.php';

    class UserApiController extends ApiController {
        private $Model;
        private $authHelper;

        function __construct() {
            parent::__construct();
            $this->authHelper = new AuthHelper();
            $this->Model = new UserModel();
        }

        function getToken($params = []) {
            $basic = $this->authHelper->getAuthHeaders(); // Darnos el header 'Authorization:' 'Basic: base64(usr:pass)'

            if(empty($basic)) {
                $this->View->response('No envió encabezados de autenticación.', 401);
                return;
            }

            $basic = explode(" ", $basic); // ["Basic", "base64(usr:pass)"]

            if($basic[0]!="Basic") {
                $this->View->response('Los encabezados de autenticación son incorrectos.', 401);
                return;
            }

            $userpass = base64_decode($basic[1]); // usr:pass
            $userpass = explode(":", $userpass); // ["usr", "pass"]

            $user = $userpass[0];
            $pass = $userpass[1];

            $userdata = $this->Model->getByUser($user); // Llamar a la DB

            if($user && password_verify($pass, $userdata->Password)) {
                // Usuario es válido
                
                $token = $this->authHelper->createToken($userdata);
                $this->View->response($token, 200);
            } else {
                $this->View->response('El usuario o contraseña son incorrectos.', 401);
            }
        }
    }
