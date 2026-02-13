import api from './api';

export async function login(email, password) {
    const response = await api.post('/login', { email, password });
    const { user, token } = response.data;
    localStorage.setItem('token', token);
    localStorage.setItem('user', JSON.stringify(user));
    localStorage.setItem('roles', JSON.stringify(user.roles));
    return user;
}

export function logout() {
    localStorage.removeItem('token');
    localStorage.removeItem('user');
    localStorage.removeItem('roles');
}
