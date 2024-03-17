import { useEffect, useState } from "react";
import axiosClient from "../axios-client.js";
import { Link, Navigate } from "react-router-dom";
import { useStateContext } from "../contexts/ContextProvider.jsx";
import React from "react";

export default function Users() {
  const [users, setUsers] = useState([]);
  const [links, setLinks] = useState([]);
  const [loading, setLoading] = useState(false);
  const { setNotification, token } = useStateContext();

  if (token) {
    <Navigate to="/login" />;
  }

  useEffect(() => {
    getUsers();
  }, []);

  const onDeleteClick = (user) => {
    if (!window.confirm("Are you sure you want to delete this user?")) {
      return;
    }
    axiosClient.delete(`/user/${user.id}`).then(() => {
      //     axiosClient.delete(`/users/${u.id}`)
      setNotification("User was successfully deleted");
      getUsers();
    });
  };

  const getUsers = (url) => {
    setLoading(true);
    axiosClient
      .get(url ?? "/user")
      .then(({ data }) => {
        setLoading(false);
        //debugger;
        console.log(data.data);
        setUsers(data.data);
        setLinks(data.meta.links);
      })
      .catch(() => {
        setLoading(false);
      });
  };

  return (
    <div>
      <div
        style={{
          display: "flex",
          justifyContent: "space-between",
          alignItems: "center",
        }}
      >
        <h1>Users</h1>
        <Link className="btn-add" to="/users/new">
          Add new
        </Link>
      </div>
      <div className="card animated fadeInDown">
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Create Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          {loading && (
            <tbody>
              <tr>
                <td colSpan="5" className="text-center">
                  Loading...
                </td>
              </tr>
            </tbody>
          )}
          {!loading && (
            <tbody>
              {users?.map((u) => (
                <tr key={u.id}>
                  <td>{u.id}</td>
                  <td>{u.username}</td>
                  <td>{u.email}</td>
                  <td>{u.created_at}</td>
                  <td>
                    <Link className="btn-edit" to={"/users/" + u.id}>
                      Edit
                    </Link>
                    &nbsp;
                    <button
                      className="btn-delete"
                      onClick={(ev) => onDeleteClick(u)}
                    >
                      Delete
                    </button>
                  </td>
                </tr>
              ))}
            </tbody>
          )}
        </table>
      </div>

      {links?.map((link) =>
        link.active === "false" ? (
          <button
            disabled
            className="btn-edit"
            onClick={() => getUsers(link.url)}
            dangerouslySetInnerHTML={{ __html: link?.label }}
          ></button>
        ) : (
          <button
            className="btn-edit"
            onClick={() => getUsers(link.url)}
            dangerouslySetInnerHTML={{ __html: link?.label }}
          ></button>
        )
      )}
    </div>
  );
}

// import { useEffect, useState } from "react";
// import axiosClient from "../axios-client";
// import { Link } from "react-router-dom";

// export default function Users() {
//   const [users, setUsers] = useState([]);
//   const [loading, setLoading] = useState(false);

//   useEffect(() => {}, []);

//   const onDelete = (u) => {
//     if(!window.confirm("Are you sure you want to delete this user?")){
//         return;
//     }

//     axiosClient.delete(`/users/${u.id}`)
//     .then(() => {
//         getUsers()
//     })
//   }

//   const getUsers = () => {
//     setLoading(true);
//     axiosClient
//       .get("/users")
//       .then(({ data }) => {
//         setLoading(false);
//         debugger;
//         console.log(data);
//         setUsers(data.data);
//       })
//       .catch(() => {
//         setLoading(false);
//       });
//   };

//   return (
//     <div>
//       <div
//         style={{
//           display: "flex",
//           justifyContent: "space-between",
//           alignItems: "center",
//         }}
//       >
//         <h1>Users</h1>
//         <Link className="btn-add" to="/users/new">
//           {" "}
//           Add New
//         </Link>
//       </div>
//       <div className="card animated fadeInDown">
//         <table>
//           <thead>
//             <tr>
//               <th>ID</th>
//               <th>Name</th>
//               <th>Email</th>
//               <th>Create Date</th>
//               <th>Actions</th>
//             </tr>
//           </thead>
//           {loading && <tbody>
//             <tr>
//                 <td colSpan="5" className='text-center>
//                 Loading...
//                 </td>
//             </tr>
//           </tbody>
//           }

//           {!loading && <tbody>
//             {users.map((u) => (
//               <tr>
//                 <td>{u.id}</td>
//                 <td>{u.name}</td>
//                 <td>{u.email}</td>
//                 <td>{u.created_at}</td>
//                 <td>
//                   <Link className="btn-edit" to={"/users/" + u.id}>
//                     Edit
//                   </Link>
//                   @nbsp;
//                   <button onClick={ev => onDelete(u)} className="btn-delete">Delete</button>
//                 </td>
//               </tr>
//             ))}
//           </tbody>

//         </table>
//       </div>
//     </div>
//   );
// }