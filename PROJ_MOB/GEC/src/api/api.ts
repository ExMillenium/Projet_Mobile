import axios from 'axios';

const api = axios.create({
  baseURL: import.meta.env.VITE_API_BASE || 'http://localhost:4000/api',
  headers: { 'Content-Type': 'application/json' }
});

export const auth = {
  login: (email: string, password: string) =>
    api.post('/auth/login', { email, password }),
  me: () => api.get('/auth/me')
};

export const timetable = {
  getForUser: (userId: string) => api.get(`/users/${userId}/timetable`)
};

export const grades = {
  getForUser: (userId: string) => api.get(`/users/${userId}/grades`)
};

export default api;
