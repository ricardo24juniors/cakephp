<?php
namespace App\Controller;

class UsuariosController extends AppController{
    
    public function initialize(){
        parent::initialize();
        $this->loadModel('Roles');
    }
    
    public function index() {
        $query = $this->Usuarios->find('all')->contain(['Roles']);
        $this->set('usuarios', $query);
    }
    
    public function registrar() {
        $usuario = $this->Usuarios->newEntity();
        
        if($this->request->is('post')){
            $usuario = $this->Usuarios->patchEntity($usuario, $this->request->data);
            if( $this->Usuarios->save($usuario) ) {
                $this->Flash->success('Registro guardado correctamente');
                $this->redirect(['action'=>'index']);
            } else {
                $this->Flash->error('Error al momento de guardar el registro');
            }
        }
        $this->set('usuario', $usuario);
        
        $query = $this->Roles->find('list');
        $this->set('roles', $query);
    }
    
    public function editar($id = null) {
        $usuario = $this->Usuarios->get($id);
        if($this->request->is('put')){ // or post <form>
            $usuario = $this->Usuarios->patchEntity($usuario, $this->request->data);
            if( $this->Usuarios->save($usuario) ) {
                $this->Flash->success('Registro guardado correctamente');
                $this->redirect(['action'=>'index']);
            } else {
                $this->Flash->error('Error al momento de guardar el registro');
            }
        }
        $this->set('usuario', $usuario);
        
        $query = $this->Roles->find('list');
        $this->set('roles', $query);
    }
    
    public function eliminar($id = null) {
        $usuario = $this->Usuarios->get($id);
        if( $this->Usuarios->delete($usuario) ) {
            $this->Flash->success('Registro eliminado correctamente');
        } else {
            $this->Flash->error('Error al momento de eliminar el registro');
        }
        $this->redirect(['action'=>'index']);
    }
    
}
