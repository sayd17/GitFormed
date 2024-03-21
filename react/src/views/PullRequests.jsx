import { useNavigate, useParams } from "react-router-dom";
import { useEffect, useState } from "react";
import axiosClient from "../axios-client.js";
import { useStateContext } from "../contexts/ContextProvider.jsx";

export default function PullRequest() {
  const navigate = useNavigate();
  const { user, setNotification } = useStateContext();
  let { owner, repo_name } = useParams();

  const [pullRequest, setPullRequest] = useState({
    owner: owner,
    repo_name: repo_name,
    title: "",
  });
  const [errors, setErrors] = useState(null);
  const [loading, setLoading] = useState(false);

  const onSubmit = (ev) => {
    ev.preventDefault();

    axiosClient
      .post("/pullrequests", pullRequest)
      .then(() => {
        setNotification("PullRequest was successfully created");
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
      <h1> Pull Request </h1>
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
              value={pullRequest.pullRequestname}
              onChange={(ev) =>
                setPullRequest({
                  ...pullRequest,
                  title: ev.target.value,
                })
              }
              placeholder="PR title"
            />

            <button className="btn">Create</button>
          </form>
        )}
      </div>
    </>
  );
}
