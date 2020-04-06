# PardonsAppV2
The Pardons App is a web application created by the Drexel App Lab at the ExCITe Center, in partnership with the PLSE (Philadelphia Lawyers for Social Equity). The application is designed to streamline the process of acquiring pardons for past crimes in the state of Pennsylvania. Questions are simplified, and a walk through script for the form helps elicit comprehensive answers while eliminating any confusion that could stem from the wording of the original form. Additionally, the application is designed to take the user inputs and automatically generate the required PDF documents. 
## Technologies Utilized
The application uses ***Laravel*** and it's ***PHP***-based framework along with ***Vue.js*** to create reactive forms, and ***MySQL*** is used for the database. The application is built on the following versions of Laravel, PHP, and MySQL and the Composer Package Manager:
>Laravel Framework v5.7.22\
PHP v7.3.4\
Composer v1.8.4\
MySQL 8.0.12\

The application uses Vue.js for the frontend of the stack, which creates asynchronous CRUD processes for the forms. We decided to utilize Vue in order to have reactive forms, where tables or subforms could be created and updated based on user responses. Versions of Vue and Axios utilized:
>Vue.js v.2.5.2\
Axios v0.18.0

## Running the App
In the root directory run the following Laravel Artisan commands. Artisan is Laravel's command line tool.
* edit the .env file to include database name and credentials
* php artisan key:generate - sets a unique key for the application
* php artisan migrate - creates the tables for the application (database/migrations)
* php artisan db:seed - creates security roles and admin user (database/seeder)

## General Directory Structure and Workflow
All working files are housed in the PardonsAppV2 folder. The following are files of note that are stored in the root folder:
* .env – This file contains the environment configurations for the application. Most commonly, this file will be edited for database purposes. Lines 9-14 contain environment configurations for database information.
* server.php – “This file allows us to emulate Apache's ‘mod_rewrite’ functionality from the built-in PHP web server. This provides a convenient way to test a Laravel application without having installed a ‘real’ web server software here.”

The first directory in alphabetical order is the /app directory. Notables directories and files in the app directory:
* /app/Http/Controllers – Contains all the controllers for the pardon application.
*	/app/Http/Controllers/Auth – Authorization and log in related controllers
*	/app – Contains php files for all the classes
*	/database/migrations – Contains the migrations for the database(essentially are templates to create tables in the database, where each migration files is equivalent to a table)
*	/resources/js/components – Contains the .vue files that build up the majority of the application
*	/resources/views/layouts – layout blade files, which mostly other level files extend off of
*	/resources/views/levels – blade files, or general template files, for each level page
## Integral Commands and Usage
Navigate to the working directory that contains the application.  
To start the web development server(by default, hosts to localhost:8000, can be changed in the .env settings): “php artisan serve” (This command will also tell you where the server is being hosted.)  
Javascript is compiled using SASS. To compile any javascript changes made to the application: “yarn run dev”.  You can also use "yarn run watch-poll" to watch for changes while developing.
To make changes to the database:  
*	“php artisan migrate” – this will create any new tables that haven’t yet been migrated.
*	“php artisan migrate:refresh” – this will ‘rollback’ all the currently existing tables, and then migrate the tables all back. Mostly used when changes are made to tables that already exist in the database. WARNING – this will delete all data that is currently in the database – i.e. user login information, application information, etc.
## Roles/Security
* roles are defined in tables Roles and assigned in Role_Users
* roles are defined in the app under app/Providers/AuthServiceProvider.php using gates and policies
* policies are called from both the web.php and api.php routers.
* the app uses a REST based architecture and security validates that the user can only see their own information.

## Data Flow
Tracing the path of data entered in a form field to the database:  
1. User enters th data into the form field
```
First Name: Ryan
```
2. The Vue App page that contains the form field, either a Level App or a Subform App, will have a label and an input v-model for that field.
```
label “fname_field” v-model “fname_field”
```
3. On form submit, each of the v-model fields are assigned to the variable of the name in a post method. 
```
axios.post(‘api/applications/store, ({… fname: this.fname_field})
```
4. The data is transferred to the post method of the respective controller. The controller will create a new object based on the existing class definition for the page/subform, and then assign the value put into the form field to the Object. 
```
$applicationObj = new Application();\
… $applicationObj->fname = $request->fname;
… $applicationObj->save()
```
5.	The data is then sent to be stored in the database, with any error messages or responses created by the database returned.
```
return response($applicationObj->jsonSerialize(), Response::HTTP_CREATED);
```
6.	The current form fields are then emptied and assigned empty values, ‘’.
```
.then (({ data }) => { this.application.push(new Education(data)); … this.fname = ''; 
```
7.	The .catch method then reports any errors to the console. 
```
.catch((error) => { if (error.response) { …}})
```

## Outline of Current Tasks
- [x] Create reactive table functionality for subforms
- [x] Complete all forms and levels based on new pardon application
- [x] Implement Collections to show input information to assist with the personal statement
- [x] Allow users to edit the information stored in tables of subforms
- [ ] Confirm modal box for deleting subforms (Schools, Jobs, Recommendations, etc.)

## Future Improvements 
* Complete implementation of PDF generator from input data
	- implemented in ApplicationsController.php
	- layout in blade files forms/page1 (html and css) (css should be moved to sass/app.scss)
	- using images public/forms
* Complete Admin dashboard
	- using AdminController.php and admin/indes.blade.php files
