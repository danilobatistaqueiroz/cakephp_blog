<?php

namespace App\Controller;

use Cake\Log\Log;
use Cake\Event\Event;

class ArticlesController extends AppController
{
    public function __contructor(){

    }
    
    public function initialize()
    {
        parent::initialize();
        

        $this->loadComponent('Flash'); // Inclui o FlashComponent
    }
    
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->response->header('Access-Control-Allow-Origin','*');
        $this->response->header('Access-Control-Allow-Methods','*');
        $this->response->header('Access-Control-Allow-Headers','X-Requested-With');
        $this->response->header('Access-Control-Allow-Headers','Origin, X-Requested-With, Content-Type, Accept, x-xsrf-token');
        $this->response->header('Access-Control-Max-Age','172800');
    }
    
    public function index()
    {        
        
        $articles = $this->Articles->find('all');
        //debug($articles, true, true);
        $this->set(compact('articles'));
        
        //$articles = json_encode($articles);
        
        //return $this->response->withType('application/json')->withStringBody($articles);
    }
    
    public function json()
    {
       
        $this->response->header('Access-Control-Allow-Origin','*');
        $this->response->header('Access-Control-Allow-Methods','*');
        $this->response->header('Access-Control-Allow-Headers','X-Requested-With');
        $this->response->header('Access-Control-Allow-Headers','Origin, X-Requested-With, Content-Type, Accept, x-xsrf-token');
        $this->response->header('Access-Control-Max-Age','172800');
        
        $articles = $this->Articles->find('all');
        //debug($articles, true, true);
        //$this->set(compact('articles'));
        
        $articles = json_encode($articles);
        
        return $this->response->withType('application/json')->withStringBody($articles);
    }
    
    public function view($id = null)
    {
        
        $article = $this->Articles->get($id);
        //Log::write('debug', $article->id);
        $this->set(compact('article'));
    }
    
    public function add()
    {
        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Seu artigo foi salvo.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não é possível adicionar o seu artigo.'));
        }
        $this->set('article', $article);
    }
    
    public function edit($id = null)
    {
        $article = $this->Articles->get($id);
        if ($this->request->is(['post', 'put'])) {
            $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Seu artigo foi atualizado.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Seu artigo não pôde ser atualizado.'));
        }

        $this->set('article', $article);
    }
    
    public function delete($id)
    {
        
        Log::write('debug', "delete usando id: $id ");

        
        //$this->request->allowMethod(['post', 'delete']);

        $article = $this->Articles->get($id);
        //if ($this->Articles->delete($article)) {
            $this->Flash->success(__('O artigo com id: {0} foi deletado.', h($id)));
            return $this->redirect(['action' => 'index']);
        // }
    }
}