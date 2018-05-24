<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$config = array(
    'dispatcher/login' => array(
        array(
            'field' => 'username',
            'label' => 'User Name',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'User Name is required field.'
            )
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'Dispatcher password is required field.',
            )
        )
    ),
    'dispatcher/dipatcher_insert_rules' => array(
        array(
            'field' => 'username',
            'label' => 'User Name',
            'rules' => 'trim|required|is_unique[911m_dispatchers.username]',
            'errors' => array(
                'required' => 'User Name is required field.',
                'is_unique' => '%s Is Already Taken.'
            )
        ),
        array(
            'field' => 'dispatcher_password',
            'label' => 'Password',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'Dispatcher password is required field.',
            )
        ),
          array(
            'field' => 'confirm_password',
            'label' => 'Confirm Password',
            'rules' => 'trim|required|matches[dispatcher_password]',
            'errors' => array(
                'required' =>  'Confirm password is required field.',
                'matches'=>'Your password does not matches'
            )
        ),
        array(
            'field' => 'franchise_id',
            'label' => 'Franchise Id',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'Franchise Id is required field.',
            )
        ),
        array(
            'field' => 'dispatcher_email',
            'label' => 'Dispatcher Email',
            'rules' => 'trim|required|valid_email|is_unique[911m_dispatchers.dispatcher_email]',
            'errors' => array(
                'required' => '%s Is required.',
                'is_unique' => '%s Is Already Taken.',
                'valid_email' => '%s must be valid. For example, johndoe@example.com'
            )
        ),
        array(
            'field' => 'dispatcher_first_name',
            'label' => 'Dispatcher First Name',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'Dispatcher First Name is required field.'
            )
        )
    ),
     'dispatcher/dipatcher_update_rules' => array(
        array(
            'field' => 'franchise_id',
            'label' => 'Franchise Id',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'Franchise Id is required field.',
            )
        ),
        array(
            'field' => 'dispatcher_email',
            'label' => 'Dispatcher Email',
            'rules' => 'trim|required|valid_email',
            'errors' => array(
                'required' => '%s Is required.',
                'is_unique' => '%s Is Already Taken.'
            )
        ),
        array(
            'field' => 'dispatcher_first_name',
            'label' => 'Dispatcher First Name',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'Dispatcher First Name is required field.'
            )
        )
    ),
    'dispatcher/changepassword' => array(
        array(
            'field' => 'password',
            'label' => 'password',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'password is required field.',
            )
        ),
        array(
            'field' => 'c_password',
            'label' => 'c_password',
            'rules' => 'trim|required|matches[password]',
            'errors' => array(
                'required' => 'Confirm password is required field.',
            )
        )
    ),
    'admin1/login' => array(
        array(
            'field' => 'username',
            'label' => 'username',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'username is required field.'
            )
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'Password is required field.',
            )
        )
    ),
    'admin/login' => array(
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'Email is required field.'
            )
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'Password is required field.',
            )
        )
    ),

    'version/insert' => array(
        array(
            'field' => 'version_name',
            'label' => 'Version Name',
            'rules' => 'trim|required|is_unique[911m_version.version_name]',
            'errors' => array(
                'required' => 'Version Name is required field.'
            )
        )
    ),
    'version/edit' => array(
        array(
            'field' => 'version_name',
            'label' => 'Version Name',
            'rules' => 'trim|required|callback_unique_name',
            'errors' => array(
                'required' => 'Version Name is required field.',
                'unique_name' => '%s value is already being used.'
            )
        )
    ),
    'neighborhood/edit' => array(
        array(
            'field' => 'neighborhood_name',
            'label' => 'Neighborhood Name',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'Neighborhood Name is required field.'
            )
        ),
        array(
            'field' => 'state_id',
            'label' => 'State id',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'state id is required field.',
            )
        )
        ,
        array(
            'field' => 'municipality_id',
            'label' => 'municipality',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'municipality  is required field.',
            )
        )
    ),
    'neighborhood/insert' => array(
        array(
            'field' => 'neighborhood_name',
            'label' => 'Page Name',
            'rules' => 'trim|required|is_unique[911m_neighborhoods.neighborhood_name]',
            'errors' => array(
                'required' => 'Neighborhood Name is required field.'
            )
        )
        ,
        array(
            'field' => 'state_id',
            'label' => 'State id',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'State Id is required field.',
            )
        )
        ,
        array(
            'field' => 'municipality_id',
            'label' => 'municipality',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'municipality  is required field.',
            )
        )
    ),
    'municipality/insert' => array(
        array(
            'field' => 'municipality_abbreviation',
            'label' => 'Neighborhood Name',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'municipality abbreviation is required field.'
            )
        ),
        array(
            'field' => 'state_id',
            'label' => 'State id',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'state id is required field.',
            )
        )
        ,
        array(
            'field' => 'municipality_name',
            'label' => 'municipality',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'municipality name is required field.',
            )
        )
    ),
	 'clientaddress/insert' => array(
        array(
            'field' => 'street',
            'label' => 'street',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'street is required field.'
            )
        ),
        array(
            'field' => 'state_id',
            'label' => 'State id',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'state is required field.',
            )
        )
        ,
        array(
            'field' => 'municipality_id',
            'label' => 'municipality',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'municipality  is required field.',
            )
        ),
		array(
            'field' => 'neighborhood_id',
            'label' => 'municipality',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'neighborhood  is required field.',
            )
        )
    ),
    'state/insert' => array(
        array(
            'field' => 'state_abbreviation',
            'label' => 'state abbreviation',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'state_abbreviation is required field.'
            )
        )
        ,
        array(
            'field' => 'state_name',
            'label' => 'state name',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'state name is required field.',
            )
        )
        ,
        array(
            'field' => 'state_capital',
            'label' => 'state capital',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'state capital  is required field.',
            )
        )
    ),
    'services/insert' => array(
       
        array(
            'field' => 'category_name_en',
            'label' => 'category name',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'Name(English) is required field.',
            )
        )
        ,
         array(
            'field' => 'category_name_sp',
            'label' => 'category name',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'Name(Spanish) is required field.',
            )
        )
        ,
        array(
            'field' => 'cost',
            'label' => 'cost',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'cost  is required field.'
            )
        ),
		 array(
            'field' => 'code',
            'label' => 'code',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'Code is required field.'
            )
        )
        
    ),
    'page/insert' => array(
        array(
            'field' => 'pages_name',
            'label' => 'Page Name',
            'rules' => 'trim|required|is_unique[911m_pages.pages_name]',
            'errors' => array(
                'required' => 'Page Name is required field.'
            )
        )
    ),
    'page/edit' => array(
        array(
            'field' => 'pages_name',
            'label' => 'Page Name',
            'rules' => 'trim|required|callback_unique_name',
            'errors' => array(
                'required' => 'Page Name is required field.',
                'unique_name' => '%s value is already being used.'
            )
        )
    ),
  
     'franchise/insert' => array(
        array(
            'field' => 'username',
            'label' => 'User Name',
            'rules' => 'trim|required|is_unique[911m_franchises.username]',
            'errors' => array(
                'is_unique' => '%s is already taken.',
                'required' => 'User Name is required field.'
            )
        ),
          array(
            'field' => 'franchise_password',
            'label' => 'Password',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'password is required field.',
            )
        ),
        array(
            'field' => 'confirm_password',
            'label' => 'Confirm Password',
            'rules' => 'trim|required|matches[franchise_password]',
            'errors' => array(
                 'required' => 'confirm password is required field.',
                'matches'=>'Your password does not matches'
            )
        ),
          array(
            'field' => 'franchise_code',
            'label' => 'Franchise code',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'Franchise code is required field.'
            )
        ),
         array(
            'field' => 'franchise_owner_first_name',
            'label' => 'Franchise Owner First Name',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'Franchise Owner First Name Is required'
            )
        ),
       array(
            'field' => 'franchise_manager_first_name',
            'label' => 'Franchise Manager First Name',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'Franchise Manager First Name Is required'
            )
        ),
         array(
            'field' => 'franchise_phone_number',
            'label' => 'Phone Number',
            'rules' => 'trim|required|numeric',
            'errors' => array(
               'required' => 'Franchise phone number required',
                'number' => '%s must be a number',
            )
        ),
       
       array(
            'field' => 'franchise_phone_number_alt',
            'label' => 'Phone Number Alternative',
            'rules' => 'trim|required|numeric',
            'errors' => array(
               'required' => 'Franchise phone number alternative required',
                'number' => '%s must be a number',
            )
        ),
       array(
            'field' => 'franchise_owner_phone_number',
            'label' => 'Owner Phone Number',
            'rules' => 'trim|required|numeric',
            'errors' => array(
               'required' => 'Franchise Owner phone number required',
                'number' => '%s must be a number',
            )
        ),
         array(
            'field' => 'franchise_owner_phone_number_alt',
            'label' => 'Owner Phone Number Alternative',
            'rules' => 'trim|required|numeric',
            'errors' => array(
               'required' => 'Franchise owner phone number alternative required',
                'number' => '%s must be a number',
            )
        ),
        array(
            'field' => 'franchise_manager_phone_number',
            'label' => 'Manager Phone Number',
            'rules' => 'trim|required|numeric',
            'errors' => array(
               'required' => 'Franchise Manager phone number required',
                'number' => '%s must be a number',
            )
        ),
       array(
            'field' => 'franchise_manager_phone_number_alt',
            'label' => 'Manager Phone Number Alternative',
            'rules' => 'trim|required|numeric',
            'errors' => array(
               'required' => 'Franchise Manager phone number Alternative required',
                'number' => '%s must be a number',
            )
        ),
        array(
            'field' => 'franchise_email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|is_unique[911m_franchises.franchise_email]',
            'errors' => array(
               'required' => 'Franchise Email Is required.',
                'is_unique' => '%s is already taken.',
                'valid_email' => '%s must be valid. For example, johndoe@example.com'
            )
        ),
      
        array(
            'field' => 'franchise_owner_email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email',
            'errors' => array(
               'required' => 'Franchise Owner Email Is required.',
                'valid_email' => 'Owner %s must be valid. For example, johndoe@example.com'
            )
        )
         ),
    'franchise/update' => array(
       
          array(
            'field' => 'franchise_code',
            'label' => 'Franchise code',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'Franchise code is required field.'
            )
        ),
         array(
            'field' => 'franchise_owner_first_name',
            'label' => 'Franchise Owner First Name',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'Franchise Owner First Name Is Required'
            )
        ),
       array(
            'field' => 'franchise_manager_first_name',
            'label' => 'Franchise Manager First Name',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'Franchise Manager First Name Is Required'
            )
        ),
         array(
            'field' => 'franchise_phone_number',
            'label' => 'Phone Number',
            'rules' => 'trim|required|numeric',
            'errors' => array(
               'required' => 'Franchise phone number Required',
                'number' => '%s must be a number',
            )
        ),
       
       array(
            'field' => 'franchise_phone_number_alt',
            'label' => 'Phone Number Alternative',
            'rules' => 'trim|required|numeric',
            'errors' => array(
               'required' => 'Franchise phone number alternative required',
                'number' => '%s must be a number',
            )
        ),
       array(
            'field' => 'franchise_owner_phone_number',
            'label' => 'Owner Phone Number',
            'rules' => 'trim|required|numeric',
            'errors' => array(
               'required' => 'Franchise Owner phone number required',
                'number' => '%s must be a number',
            )
        ),
         array(
            'field' => 'franchise_owner_phone_number_alt',
            'label' => 'Owner Phone Number Alternative',
            'rules' => 'trim|required|numeric',
            'errors' => array(
               'required' => 'Franchise Owner Phone Number Alternative Required',
                'number' => '%s must be a number',
            )
        ),
        array(
            'field' => 'franchise_manager_phone_number',
            'label' => 'Manager Phone Number',
            'rules' => 'trim|required|numeric',
            'errors' => array(
               'required' => 'Franchise Manager Phone Number Required',
                'number' => '%s must be a number',
            )
        ),
       array(
            'field' => 'franchise_manager_phone_number_alt',
            'label' => 'Manager Phone Number Alternative',
            'rules' => 'trim|required|numeric',
            'errors' => array(
               'required' => 'Franchise Manager Phone Number Alternative Required',
                'number' => '%s must be a number',
            )
        ),
        array(
            'field' => 'franchise_email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email',
            'errors' => array(
               'required' => 'Franchise Email Is Required.',
              
                'valid_email' => ' %s must be valid. For example, johndoe@example.com'
            )
        ),
      
        array(
            'field' => 'franchise_owner_email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email',
            'errors' => array(
               'required' => 'Franchise Owner Email Is Required.',
                'valid_email' => 'Owner %s must be valid. For example, johndoe@example.com'
            )
        )
         ),
    'technician/insert' => array(
       
          array(
            'field' => 'contractor_id',
            'label' => 'contractor id',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'contractor id required field.'
            )
        ),
         array(
            'field' => 'technician_first_name',
            'label' => 'technician  First Name',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => ' First Name Is Required'
            )
        ),
		array(
            'field' => 'username',
            'label' => 'user Name',
            'rules' => 'trim|required|is_unique[911m_technicians.username]',
            'errors' => array(
                'is_unique' => '%s is already taken.',
                'required' => 'User Name Is Required'
            )
        ),
        
		array(
            'field' => 'technician_password',
            'label' => 'technician  First Name',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'Password Is Required'
            )
        ),
        
        
        array(
            'field' => 'confirm_password',
            'label' => 'Confirm Password',
            'rules' => 'trim|required|matches[technician_password]',
            'errors' => array(
                 'required' => 'password is required field.',
                'matches'=>'Your password does not matches'
            )
        ),
      
         array(
            'field' => 'technician_phone_number',
            'label' => 'Phone Number',
            'rules' => 'trim|required|numeric',
            'errors' => array(
               'required' => 'technician Phone Number Required',
                'number' => '%s must be a number',
            )
        ),
       
       array(
            'field' => 'technician_phone_number_alt',
            'label' => 'Phone Number Alternative',
            'rules' => 'trim|required|numeric',
            'errors' => array(
               'required' => 'technician Phone Number Alternative Required',
                'number' => '%s must be a number',
            )
        ),
      
        
        array(
            'field' => 'technician_email',
            'label' => 'Email',
            'rules' => 'trim|required|is_unique[911m_technicians.technician_email]|valid_email',
            'errors' => array(
               'required' => 'technician Email Is Required.',
                'is_unique' => '%s is already taken.',
                'valid_email' => '%s must be valid. For example, johndoe@example.com'
            )
        )
       ) ,
     'technician/update' => array(
       
          array(
            'field' => 'contractor_id',
            'label' => 'contractor id',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'contractor id required field.'
            )
        ),
         array(
            'field' => 'technician_first_name',
            'label' => 'technician  First Name',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => ' First Name Is Required'
            )
        ),
		array(
            'field' => 'username',
            'label' => 'user Name',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'User Name Is Required'
            )
        ),
		
      
         array(
            'field' => 'technician_phone_number',
            'label' => 'Phone Number',
            'rules' => 'trim|required|numeric',
            'errors' => array(
               'required' => 'technician Phone Number Required',
                'number' => '%s must be a number',
            )
        ),
       
       array(
            'field' => 'technician_phone_number_alt',
            'label' => 'Phone Number Alternative',
            'rules' => 'trim|required|numeric',
            'errors' => array(
               'required' => 'technician Phone Number Alternative Required',
                'number' => '%s must be a number',
            )
        ),
      
        
        array(
            'field' => 'technician_email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email',
            'errors' => array(
               'required' => 'technician Email Is Required.',
               
                'valid_email' => '%s must be valid. For example, johndoe@example.com'
            )
        )
       ) ,
    'client/insert' => array(
        array(
            'field' => 'username',
            'label' => 'User Name',
            'rules' => 'trim|required|is_unique[911m_clients.client_email]',
            'errors' => array(
                 'is_unique' => '%s Is Already Taken.',
                'required' => 'User Name is required field.'
            )
        ),
          array(
            'field' => 'client_type',
            'label' => 'client type',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'Type is required field.'
            )
        ),
         array(
            'field' => 'client_first_name',
            'label' => 'client  First Name',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'First Name Is Required'
            )
        ),
      
         array(
            'field' => 'client_phone_number',
            'label' => 'Phone Number',
            'rules' => 'trim|required|numeric',
            'errors' => array(
               'required' => 'Phone Number Required',
                'number' => '%s must be a number',
            )
        ),
        array(
            'field' => 'client_password',
            'label' => 'Password',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'password is required field.',
            )
        ),
        array(
            'field' => 'confirm_password',
            'label' => 'Confirm Password',
            'rules' => 'trim|required|matches[client_password]',
            'errors' => array(
                 'required' => 'password is required field.',
                'matches'=>'Your password does not matches'
            )
        ),
      
       array(
            'field' => 'client_phone_country_code',
            'label' => ' Phone Number country code',
            'rules' => 'trim|required|numeric',
            'errors' => array(
               'required' => 'Phone Number country code Required',
                'number' => '%s must be a number',
            )
        ),
        
        array(
            'field' => 'client_email',
            'label' => 'Email',
            'rules' => 'trim|required|is_unique[911m_clients.client_email]|valid_email',
            'errors' => array(
               'required' => 'Email Is Required.',
                'is_unique' => '%s is already taken.',
                'valid_email' => '%s must be valid. For example, johndoe@example.com'
            )
        )
      
       
         ), 
		 'client/update' => array(
      
          array(
            'field' => 'client_type',
            'label' => 'client type',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'Type is required field.'
            )
        ),
         array(
            'field' => 'client_first_name',
            'label' => 'client  First Name',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'First Name Is Required'
            )
        ),
      
         array(
            'field' => 'client_phone_number',
            'label' => 'Phone Number',
            'rules' => 'trim|required|numeric',
            'errors' => array(
               'required' => 'Phone Number Required',
                'number' => '%s must be a number',
            )
        ),
       
      
       array(
            'field' => 'client_phone_country_code',
            'label' => ' Phone Number country code',
            'rules' => 'trim|required|numeric',
            'errors' => array(
               'required' => 'Phone Number country code Required',
                'number' => '%s must be a number',
            )
        ),
        
        array(
            'field' => 'client_email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email',
            'errors' => array(
               'required' => 'Email Is Required.',
                
                'valid_email' => '%s must be valid. For example, johndoe@example.com'
            )
        )
      
       
         ),
    'contractor/insert' => array(
       
          array(
            'field' => 'contractor_code',
            'label' => 'contractor code',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'contractor code is required field.'
            )
        ),
         array(
            'field' => 'contractor_first_name',
            'label' => 'contractor  First Name',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'contractor  First Name Is required'
            )
        ),
      
         array(
            'field' => 'contractor_phone_number',
            'label' => 'Phone Number',
            'rules' => 'trim|required|numeric',
            'errors' => array(
               'required' => 'contractor Phone Number required',
                'number' => '%s must be a number',
            )
        ),
       
       array(
            'field' => 'contractor_phone_number_alt',
            'label' => 'Phone Number Alternative',
            'rules' => 'trim|required|numeric',
            'errors' => array(
               'required' => 'contractor Phone Number Alternative Required',
                'number' => '%s must be a number',
            )
        ),
      
        
        array(
            'field' => 'contractor_email',
            'label' => 'Email',
            'rules' => 'trim|required|is_unique[911m_contractors.contractor_email]|valid_email',
            'errors' => array(
               'required' => 'contractor email Is required.',
                'is_unique' => '%s is already Taken.',
                'valid_email' => '%s must be valid. For example, johndoe@example.com'
            )
        )
       ), 
    'contractor/update' => array(
       
          array(
            'field' => 'contractor_code',
            'label' => 'contractor code',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'contractor code is required field.'
            )
        ),
         array(
            'field' => 'contractor_first_name',
            'label' => 'contractor  First Name',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'contractor  First Name Is Required'
            )
        ),
      
         array(
            'field' => 'contractor_phone_number',
            'label' => 'Phone Number',
            'rules' => 'trim|required|numeric',
            'errors' => array(
               'required' => 'contractor Phone Number Required',
                'number' => '%s must be a number',
            )
        ),
       
       array(
            'field' => 'contractor_phone_number_alt',
            'label' => 'Phone Number Alternative',
            'rules' => 'trim|required|numeric',
            'errors' => array(
               'required' => 'contractor Phone Number Alternative Required',
                'number' => '%s must be a number',
            )
        ),
      
        
        array(
            'field' => 'contractor_email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email',
            'errors' => array(
               'required' => 'contractor Email Is Required.',
                'valid_email' => '%s must be valid. For example, johndoe@example.com'
            )
        )
       ) 
     
);
?>
