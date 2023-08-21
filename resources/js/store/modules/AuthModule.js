import { defineStore } from 'pinia'

// import { STATUS } from '@/store/baseTypes'
// import { setHeader } from './utils'
import axios from '../../plugins/axios'


const state = {
  status: "idle",
  last_fetched: null,
  data: {},
}

const actions = {
  async authLogin(email, password) {
    this.status = STATUS.FETCHING
    try {
      const response = axios.post('/auth/login', {
        username: email,
        password: password,
        isAdmin: true,
      })

      this.data = response.data

      return response
    } catch (e) {
      this.status = "idle"
      throw e
    }
  },

  async check(){
    const response = axios.get('/test')

    return response
  }
}

const persistenceConfig = {
  beforeRestore: context => {
    console.log(`about to restore '${context.store.$id}'`)
  },
  paths: ['data'],
}

export const useAuthStore = defineStore({
  id: 'auth',
  state: () => (state),
  actions: actions,
  persist: persistenceConfig,
})
