//--------------------------------------------------------------
// PRODUCT PAGE JS
//--------------------------------------------------------------
import {TabAccordion} from './tab-accordion';

new TabAccordion('.js-custom-tabs', '.js-tab-trigger', '.js-tab-content', false, true, true, true);
new TabAccordion('.js-product-accordion', '.js-product-accordion__link', '.js-product-accordion__content', true, false, false, false);
new TabAccordion('.js-faqs-accordion', '.js-faqs-accordion__link', '.js-faqs-accordion__content', true, false, false, false);
new TabAccordion('.js-product-faq', '.js-product-faq__link', '.js-product-faq__content', true, false, false, false);

