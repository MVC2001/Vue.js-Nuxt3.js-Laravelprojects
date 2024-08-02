// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },
 
  app: {
    head: {
      title:'Crude app nuxt',
      meta:[
        {charset: 'utf-8'},
        {name: 'viewport',content:'width=device-width, initial-scale=1'},
        {hid: 'description',name:'description',content:'Crude app nuxt'},
        {name:'form-detection',content:'telephone-no'}
      ],
      link:[
        {
          rel: 'stylesheet',
          href: 'https://fonts.googleapis.com/css2?family=Roboto&display=swap',
        },

        {
          rel: 'stylesheet',
          href: 'vendor/bootstrap/css/bootstrap.min.css',
        },

        {
          rel: 'stylesheet',
          href: 'vendor/bootstrap-icons/bootstrap-icons.css',
        },

        {
          rel: 'stylesheet',
          href: 'vendor/aos/aos.css',
        },

        {
          rel: 'stylesheet',
          href: 'https://fonts.googleapis.com/css2?family=Roboto&display=swap',
        },

        {
          rel: 'stylesheet',
          href: 'vendor/glightbox/css/glightbox.min.css',
        },

        {
          rel: 'stylesheet',
          href: 'vendor/swiper/swiper-bundle.min.css',
        },

        {
          rel:'icon',
          type:'image/x-icon',
          href:'/favicon.ico'
        },
        {
          rel:'stylesheet',
          href:'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css'
        }
      ],
      script:[
        {
          src:'https://code.jquery.com/jquery-3.5.1.slim.min.js',
          type:'text/javascript'
        },
        {
          src:'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js',
          type:'text/javascript'
        }

      ]
    }
  },
  generate:{
    fallback:true
  }
  
})
