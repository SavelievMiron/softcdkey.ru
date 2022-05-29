/**
 * Manage global libraries like jQuery or THREE from the webpack.mix.js file
 */
import './blocks/header/header';
import './blocks/cart/cart';
import './blocks/main/main';
import './blocks/catalog/catalog';
import './blocks/product/product';
import './blocks/faq/faq';
import './blocks/profile/profile';
import './blocks/checkout/checkout';
// import "./blocks/catalog/sidebar/sidebar";
import './blocks/campaign/archive/archive';
import './components/search/search';
import './components/about-banner/about-banner';
// import "./components/pagination/pagination";
import './blocks/footer/footer';
import './components/modals/authorization/authorization';
import './components/modals/registration/registration';
import './components/modals/search/search';
import App from './modules/app.js';

new App();
