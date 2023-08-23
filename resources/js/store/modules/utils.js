export const setHeader = () => {
    return {
      headers: {
        Authorization: `Bearer ${localStorage.getItem("authToken")}`,
      },
    };
  };