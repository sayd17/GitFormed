import { useEffect, useState } from "react";
import axiosClient from "../axios-client.js";
import { Link, Navigate } from "react-router-dom";
import { useStateContext } from "../contexts/ContextProvider.jsx";
import React from "react";

export default function Notifications() {
  const [notifications, setNotifications] = useState([]);
  const [links, setLinks] = useState([]);
  const [loading, setLoading] = useState(false);
  const { setNotification, token } = useStateContext();

  useEffect(() => {
    getNotifications();
  }, []);

  const watching = () => {};

  const getNotifications = (url) => {
    setLoading(true);
    axiosClient
      .get(url ?? "/notifications")
      .then(({ data }) => {
        setLoading(false);
        // debugger;
        console.log(data.data);
        setNotifications(data.data);
        setLinks(data.meta.links);
      })
      .catch(() => {
        setLoading(false);
      });
  };

  return (
    <div>
      <div className="card animated fadeInDown">
        <table>
          <thead>
            <tr>
              <th>Username</th>
              <th>Owner</th>
              <th>Repository Name</th>
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
              {notifications?.map((u) => (
                <tr key={u.id}>
                  <td>{u.username}</td>
                  <td>{u.owner}</td>
                  <td>{u.repo_name}</td>
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
            onClick={() => getNotifications(link.url)}
            dangerouslySetInnerHTML={{ __html: link?.label }}
          ></button>
        ) : (
          <button
            className="btn-edit"
            onClick={() => getNotifications(link.url)}
            dangerouslySetInnerHTML={{ __html: link?.label }}
          ></button>
        )
      )}
    </div>
  );
}
