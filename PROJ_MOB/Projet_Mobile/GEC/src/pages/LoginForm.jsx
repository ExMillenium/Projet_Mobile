import { useContext, useState } from "react";
import { useNavigate } from "react-router-dom";
import { AuthContext } from "./context/AuthContext";

export default function LoginForm() {
  const { login } = useContext(AuthContext);
  const navigate = useNavigate();
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");

  const handleSubmit = async (e) => {
    e.preventDefault();
    await login({ email, password });
    navigate("/");
  };

  return (
    <form onSubmit={handleSubmit}>
      <h1>Connexion</h1>
      <input
        type="email"
        placeholder="Email"
        value={email}
        onChange={(e) => setEmail(e.target.value)}
      />
      <input
        type="password"
        placeholder="Mot de passe"
        value={password}
        onChange={(e) => setPassword(e.target.value)}
      />
      <button type="submit">Se connecter</button>
    </form>
  );
}