import Vue from 'vue';
import VueI18n from 'vue-i18n';
import Cookies from 'js-cookie';

import enLocale from './en';
import viLocale from './vi';

Vue.use(VueI18n);

const messages = {
  en: {
    ...enLocale,
  },
  vi: {
    ...viLocale,
  },
};

export function getLanguage() {
  const chooseLanguage = Cookies.get('language');
  if (chooseLanguage) {
    return chooseLanguage;
  }

  const language = (navigator.language || navigator.browserLanguage).toLowerCase();
  const locales = Object.keys(messages);
  return locales.includes(language) ? language : 'en';
}
const i18n = new VueI18n({
  locale: getLanguage(),
  messages,
});

export default i18n;
