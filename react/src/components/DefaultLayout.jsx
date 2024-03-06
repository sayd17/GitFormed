import { Link, Navigate, Outlet } from "react-router-dom";
import { useStateContext } from "../contexts/ContextProvider";

export default function DefaultLayout() {
    const { user, token } = useStateContext();

    // if token not exists
    if (!token) {
        return <Navigate to="/login" />;
    }

    const onLogout = (ev) => {};

    return (
        <div id="defaultLayout">
            <aside>
                <Link to="/dashboard">Dashboard</Link>
                <Link to="/users">Users</Link>
            </aside>
            <div className="content">
                <header>
                    <div>Header</div>
                </header>
                <div>
                    {user.name}
                    <a href="#" onClick={onLogout} className="btn-logout">
                        Logout
                    </a>
                </div>
                <div>User Info</div>
            </div>
            <main>
                <Outlet />
            </main>
        </div>
    );
}
