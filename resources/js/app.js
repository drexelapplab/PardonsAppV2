
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require( 'jquery' );

require('./bootstrap');
import Vue from 'vue'

Vue.config.devtools = true;
Vue.config.performance = true;
//Vue.use(VueRouter);


//Vue.http.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))


Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
	

//LEVEL 1 APPLICATION FORM
import Level1App from './components/Level1App.vue';
if(~window.location.pathname.indexOf("level1/")){

	const level1app = new Vue({
		el:'#level1app',
		components: {
			Level1App
		},
		render: h => h(Level1App)

	});
}
//LEVEL 2 APPLICATION FORM
import Level2App from './components/Level2App.vue';
if(~window.location.pathname.indexOf("level2")){

	const level2app = new Vue({
		el:'#level2app',
		components: {
			Level2App
		},
		render: h => h(Level2App)

	});
}

//LEVEL 2 SUB-FORMS
import JobApp from './components/JobApp.vue';
import RecommendApp from './components/RecommendApp.vue';
import EducationApp from './components/EducationApp.vue';

if(~window.location.pathname.indexOf("level2")){
	//JOB SUB-FORM LEVEL 2
	const jobapp = new Vue({
		el:'#jobapp',
		components: {
			JobApp
		},
		render: h => h(JobApp)

	});

	//JOB SUB-FORM LEVEL 2
	const recommendapp = new Vue({
		el:'#recommendapp',
		components: {
			RecommendApp
		},
		render: h => h(RecommendApp)

	});
	
	//JOB SUB-FORM LEVEL 2
	const educationapp = new Vue({
		el:'#educationapp',
		components: {
			EducationApp
		},
		render: h => h(EducationApp)

	});
}

//LEVEL 3 APPLICATION FORM
import Level3App from './components/Level3App.vue';
if(~window.location.pathname.indexOf("level3")){

	const level3app = new Vue({
		el:'#level3app',
		components: {
			Level3App
		},
		render: h => h(Level3App)

	});
}

//LEVEL 3 SUB-FORMS
import VolunteerApp from './components/VolunteerApp.vue';
if(~window.location.pathname.indexOf("level3")){
	const volunteerapp = new Vue({
		el:'#volunteerapp',
		components: {
			VolunteerApp
		},
		render: h=> h(VolunteerApp)
	});
}

//LEVEL 4 APPLICATION FORM
import Level4App from './components/Level4App.vue';
if(~window.location.pathname.indexOf("level4")){

	const level4app = new Vue({
		el:'#level4app',
		components: {
			Level4App
		},
		render: h => h(Level4App)

	});
}

//LEVEL 5 APPLICATION FORM
import Level5App from './components/Level5App.vue';
if(~window.location.pathname.indexOf("level5")){

	const level5app = new Vue({
		el:'#level5app',
		components: {
			Level5App
		},
		render: h => h(Level5App)

	});
}

//LEVEL 6 APPLICATION FORM
import Level6App from './components/Level6App.vue';
if(~window.location.pathname.indexOf("level6")){

	const level6app = new Vue({
		el:'#level6app',
		components: {
			Level6App
		},
		render: h => h(Level6App)

	});
}

//LEVEL 7 SUB-FORMS
import Level7App from './components/Level7App.vue';
import ConvictionApp from './components/ConvictionApp.vue';
import CrimeApp from './components/CrimeApp.vue';
//import NoCrimeApp from './components/NoCrimeApp.vue';

if(~window.location.pathname.indexOf("level7")){

//LEVEL7 FORM	
	const level7app = new Vue({
		el:'#level7app',
		components: {
			Level7App
		},
		render: h => h(Level7App)

	});

//CONVICTIONS SUB-FORM FOR LEVEL 7
	const convictionapp = new Vue({
		el:'#convictionapp',
		components: {
			ConvictionApp
		},
		render: h => h(ConvictionApp)

	});

//CRIMES SUB-FORM FOR LEVEL 7
	// const crimeapp = new Vue({
	// 	el:'#crimeapp',
	// 	components: {
	// 		CrimeApp
	// 	},
	// 	render: h => h(CrimeApp)

	// });

//NO-CRIMES SUB-FORM FOR LEVEL 7

	// const nocrimeapp = new Vue({
	// 	el:'#nocrimeapp',
	// 	components: {
	// 		NoCrimeApp
	// 	},
	// 	render: h => h(NoCrimeApp)
	// });
}


//LEVEL 8 - SUB-FORMS
import Level8App from './components/Level8App.vue';
import NoPardonApp from './components/NoPardonApp.vue';
import YouthCrimeApp from './components/YouthCrimeApp.vue';
import CitationApp from './components/CitationApp.vue';

if(~window.location.pathname.indexOf("level8")){

//LEVEL8 FORM	
	const level8app = new Vue({
		el:'#level8app',
		components: {
			Level8App
		},
		render: h => h(Level8App)

	});

//NO-PARDONS SUB-FORM FOR LEVEL 8
	const nopardonapp = new Vue({
		el:'#nopardonsapp',
		components: {
			NoPardonApp
		},
		render: h => h(NoPardonApp)
	});

//YOUTH CRIMES SUB-FORM FOR LEVEL 8

	const youthcrimeapp = new Vue({
		el:'#youthcrimesapp',
		components: {
			YouthCrimeApp
		},
		render: h => h(YouthCrimeApp)
	});

	//CITATIONS SUB-FORM

	const citationsapp = new Vue({
		el:'#citationsapp',
		components: {
			CitationApp
		},
		render: h => h(CitationApp)
	});	


}

//LEVEL 9 SUB-FORMS
import Level9App from './components/Level9App.vue';
if(~window.location.pathname.indexOf("level9")){

	const level9app = new Vue({
		el:'#level9app',
		components: {
			Level9App
		},
		render: h => h(Level9App)

	});
}
//LEVEL 10 SUB-FORMS

if(~window.location.pathname.indexOf("level10")){
	//place holder
}

export function checkdate(d) {
	// regular expression to match required date format
	var re = /^\d{1,2}\/\d{1,2}\/\d{4}$/;

//TODO check for months more than 13 and days more than 31
//var re = /^\d{1[0-2],2[1-2]}\/\d{2[0-31]}\/\d{4[0-9]}$/;

//^(1[0-2]|0[1-9])/(3[01]|[12][0-9]|0[1-9])/[0-9]{4}$
	if(d != '' && !d.match(re)) {
	  return false;
	}

	return true;		    
}
