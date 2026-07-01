import { createContext, useState, useEffect } from "react";
import { useContext } from "react";
import { LoginForm } from "../pages/LoginForm";

export const AuthContext = createContext(null);

export function AuthProvider({ children }) {
  const [user, setUser] = useState(null);

  useEffect(() => {
    const savedUser = localStorage.getItem("user");
    if (savedUser) {
      setUser(JSON.parse(savedUser));
    }
  }, []);

  const login = async ({ email, password }) => {
    // Ici tu pourras appeler ton backend plus tard
    const fakeUser = {
      id: 1,
      email,
      name: email.split("@")[0],
    };
  };

  const logout = () => {
    setUser(null);
    localStorage.removeItem("user");
  };

  return (
    <AuthContext.Provider value={{ user, login, logout }}>
      {children}
    </AuthContext.Provider>
  );
}