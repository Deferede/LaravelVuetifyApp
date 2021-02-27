import Vue from 'vue'
import stringHelpers from './string-helpers'

export default {
  install: () => {
    Vue.prototype.stringHelpers = stringHelpers
    Vue.stringHelpers = stringHelpers
  }
}

