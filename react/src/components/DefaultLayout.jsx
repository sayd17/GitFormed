import { Link, Navigate, Outlet } from "react-router-dom";
import { useStateContext } from "../contexts/ContextProvider";
import { useEffect, useState } from "react";
import axiosClient from "../axios-client";

const BASE_API_URL = "http://127.0.0.1:8000";

export default function DefaultLayout() {
  const {
    user,
    loggedInUser,
    token,
    notification,
    setUser,
    setToken,
    setLoggedInUser,
  } = useStateContext();

  // console.log(token);
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
      setLoggedInUser(null);
      localStorage.removeItem("LOGGED_IN_USER");
    });
  };

  useEffect(() => {
    axiosClient.get("/user").then(({ data }) => {
      setUser(data);
      console.log(data);
      // debugger;
    });
  }, []);

  useEffect(() => {
    let userInfo = localStorage.getItem("LOGGED_IN_USER");
    userInfo = JSON.parse(userInfo);
    setLoggedInUser(userInfo);
  }, []);

  return (
    // Default Layout
    <div id="defaultLayout">
      {/* Sidebar */}
      <aside>
        <Link to="/users">Users</Link>
        <Link to="/repositories">Repositories</Link>
        <Link to="/myrepositories">My Repositories</Link>
        <Link to="/mywatch">Watching</Link>
        <Link to="/notifications">Notification</Link>
      </aside>
      {/* content */}
      <div className="content">
        <header>
          <div>
            <div> Header </div>
          </div>

          <div>
            {user.username}
            &nbsp; &nbsp;
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
