<?php
    namespace App\Filters;
    use CodeIgniter\HTTP\RequestInterface;
    use CodeIgniter\HTTP\ResponseInterface;
    use CodeIgniter\Filters\FilterInterface;
    class RoleFilter implements FilterInterface {
        public function before(RequestInterface $request, $arguments = null) {
            $session = session();
            if(!$session->get('user') || !in_array($session->get('user')['user_role'], $arguments ?? [])) {
                return redirect()->back()->with('error', 'Acces refuse! Droits insuffisants');
            }
        }

        public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
            // pass
        }
    }

?>