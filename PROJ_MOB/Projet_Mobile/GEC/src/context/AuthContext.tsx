import React, { createContext, useState, useEffect, ReactNode } from "react";
// import { User } from '../types';
import { auth } from "../api/api";

interface AuthContextValue {
  user: User | null;
  token: string | null;
  login: (email: string, password: string) => Promise<void>;
  logout: () => void;
}

export const AuthContext = createContext<AuthContextValue | undefined>(
  undefined,
);

export const AuthProvider = ({ children }: { children: ReactNode }) => {
  const [user, setUser] = useState<User | null>(null);
  const [token, setToken] = useState<string | null>(
    localStorage.getItem("token"),
  );

  useEffect(() => {
    if (token) {
      auth
        .me()
        .then((res) => setUser(res.data))
        .catch(() => {
          setUser(null);
          setToken(null);
        });
    }
  }, [token]);

  const login = async (email: string, password: string) => {
    const res = await auth.login(email, password);
    const t = res.data.token;
    localStorage.setItem("token", t);
    setToken(t);
    const me = await auth.me();
    setUser(me.data);
  };

  const logout = () => {
    localStorage.removeItem("token");
    setToken(null);
    setUser(null);
  };

  return (
    <AuthContext.Provider value={{ user, token, login, logout }}>
      {children}
    </AuthContext.Provider>
  );
};
