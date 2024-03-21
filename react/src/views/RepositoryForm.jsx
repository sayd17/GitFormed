import { useNavigate, useParams } from "react-router-dom";
import { useEffect, useState } from "react";
import axiosClient from "../axios-client.js";
import { useStateContext } from "../contexts/ContextProvider.jsx";

export default function RepositoryForm() {
  const navigate = useNavigate();
  const { user, setNotification } = useStateContext();

  const [repository, setRepository] = useState({
    owner: user.username,
    repo_name: "",
    no_of_watchers: 1,
  });
  const [errors, setErrors] = useState(null);
  const [loading, setLoading] = useState(false);

  const onSubmit = (ev) => {
    ev.preventDefault();

    axiosClient
      .post("/repositories", repository)
      .then(() => {
        setNotification("Repository was successfully created");
        navigate("/repositories");
      })
      .catch((err) => {
        const response = err.response;
        if (response && response.status === 422) {
          setErrors(response.data.errors);
        }
      });
  };

  return (
    <>
      <h1> New Repository </h1>
      <div className="card animated fadeInDown">
        {loading && <div className="text-center">Loading...</div>}
        {errors && (
          <div className="alert">
            {Object.keys(errors).map((key) => (
              <p key={key}>{errors[key][0]}</p>
            ))}
          </div>
        )}
        {/*  Submit form */}
        {!loading && (
          <form onSubmit={onSubmit}>
            <input
              value={repository.repositoryname}
              onChange={(ev) =>
                setRepository({
                  ...repository,
                  repo_name: ev.target.value,
                })
              }
              placeholder="Repository Name"
            />

            <button className="btn">Save</button>
          </form>
        )}
      </div>
    </>
  );
}
