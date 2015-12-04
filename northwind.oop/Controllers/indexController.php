<?php
class indexController extends baseController{

    #region Constructors and Destructors
    public function __construct(){
        parent::__construct();
    }
    #endregion

    #region Getter and Setters

    #endregion

    #region functions and Methods
    public function index(){
        $model = 'index';
        //load model into registry
        $this->load->model($model);

        //get data for view
        $vars['pageTitle'] = 'Welcome to the NorthWind Store';
        $vars['posts'] = $this->$model->getEntries();

        //load view
        $this->load->view($model, $vars);
    }
    public function home(){
        $model = 'home';
        //load model into registry
        $this->load->model($model);

        //get data for view
        $vars['pageTitle'] = 'Welcome to the NorthWind Store';
        //$vars['posts'] = $this->$model->getEntries();

        //load view
        $this->load->view($model, $vars);
    }
    public function get(){
        echo '<pre>'.print_r(__METHOD__, true).'</pre>';	
		echo '<pre>'.print_r(func_get_args(), true).'</pre>';
    }
    #endregion
}
    
