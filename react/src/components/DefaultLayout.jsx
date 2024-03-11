import { Link, Navigate, Outlet } from "react-router-dom";
import { useStateContext } from "../contexts/ContextProvider";
import { useEffect } from "react";
import axiosClient from "../axios-client";

const BASE_API_URL = "http://127.0.0.1:8000";

export default function DefaultLayout() {
  const { user, token, notification, setUser, setToken } = useStateContext();
  console.log(token);
  // if token not exists
  if (!token) {
    // debugger;
    return <Navigate to="/login" />;
  }

  const onLogout = (ev) => {
    ev.preventDefault();

    // axiosClient.post(BASE_API_URL + "/api/logout").then(() => {
    axiosClient.post("/logout").then(() => {
      setUser({});
      setToken(null);
    });
  };

  useEffect(() => {
    axiosClient.get("/user").then(({ data }) => {
      setUser(data);
    });
  }, []);

  return (
    // Default Layout
    <div id="defaultLayout">
      {/* Sidebar */}
      <aside>
        <Link to="/dashboard">Dashboard</Link>
        <Link to="/users">Users</Link>
      </aside>
      {/* content */}
      <div className="content">
        <header>
          <div>
            <div> Header </div>
          </div>

          <div>
            {user.name}
            {/* <a href="#" onClick={onLogout} className="btn-logout">
              Logout
            </a> */}
            <a onClick={onLogout} className="btn-logout" href="#">
              Logout
            </a>
          </div>
        </header>
        {/* Main component render here */}
        <main>
          <Outlet />
        </main>
      </div>
      {notification && <div className="notification">{notification}</div>}
    </div>
  );
}
