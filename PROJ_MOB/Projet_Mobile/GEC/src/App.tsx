import React, { useContext } from "react";
import { AuthProvider, AuthContext } from "./context/AuthContext";
import { BrowserRouter, Routes, Route, Navigate } from "react-router-dom";
import "./App.css";

import LoginForm from "./pages/LoginForm";
import Dashboard from "./pages/Dashboard";
import Timetable from "./pages/Timetable";
import Grades from "./pages/Grades";
import Messages from "./pages/Messages";

const PrivateRoute = ({ children }) => {
  const ctx = useContext(AuthContext);

  if (!ctx) return <Navigate to="/login" replace />;
  return ctx.user ? children : <Navigate to="/login" replace />;
};

function App() {
  return (
    <AuthProvider>
      <BrowserRouter>
        <Routes>
          <Route path="/login" element={<LoginForm />} />

          <Route
            path="/"
            element={
              <PrivateRoute>
                <Dashboard />
              </PrivateRoute>
            }
          />

          <Route
            path="/timetable"
            element={
              <PrivateRoute>
                <Timetable />
              </PrivateRoute>
            }
          />

          <Route
            path="/grades"
            element={
              <PrivateRoute>
                <Grades />
              </PrivateRoute>
            }
          />

          <Route
            path="/messages"
            element={
              <PrivateRoute>
                <Messages />
              </PrivateRoute>
            }
          />
        </Routes>
      </BrowserRouter>
    </AuthProvider>
  );
}

export default App;
