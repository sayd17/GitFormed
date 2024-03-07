import { Link, Navigate, Outlet } from "react-router-dom";
import { useStateContext } from "../contexts/ContextProvider";

export default function DefaultLayout() {
  const { user, token } = useStateContext();
  console.log(token);
  // if token not exists
  if (!token) {
    return <Navigate to="/login" />;
  }

  const onLogout = (ev) => {
    ev.preventDefault();
  };

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
        <div>
          <header>
            <div> Content Header</div>
          </header>
        </div>

        <div>
          {user.name}
          <a href="#" onClick={onLogout} className="btn-logout">
            Logout
          </a>
        </div>
      </div>
      {/* Main component render here */}
      <main>
        <Outlet />
      </main>
    </div>
  );
}
