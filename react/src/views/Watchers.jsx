import { useEffect, useState } from "react";
import axiosClient from "../axios-client.js";
import { Link, Navigate } from "react-router-dom";
import { useStateContext } from "../contexts/ContextProvider.jsx";
import React from "react";

export default function Watchers() {
  const [watchers, setWatchers] = useState([]);
  const [links, setLinks] = useState([]);
  const [loading, setLoading] = useState(false);
  const { setNotification, token } = useStateContext();

  useEffect(() => {
    getWatchers();
  }, []);

  const watching = () => {};

  const getWatchers = (url) => {
    setLoading(true);
    axiosClient
      .get(url ?? "/mywatch")
      .then(({ data }) => {
        setLoading(false);
        // debugger;
        // console.log(data.data);
        setWatchers(data.data);
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
              <th>Repository Name</th>
              <th>Owner</th>
              <th>Username</th>
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
              {watchers?.map((u) => (
                <tr key={u.id}>
                  <td>{u.repo_name}</td>
                  <td>{u.owner}</td>
                  <td>{u.username}</td>
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
            onClick={() => getWatchers(link.url)}
            dangerouslySetInnerHTML={{ __html: link?.label }}
          ></button>
        ) : (
          <button
            className="btn-edit"
            onClick={() => getWatchers(link.url)}
            dangerouslySetInnerHTML={{ __html: link?.label }}
          ></button>
        )
      )}
    </div>
  );
}
