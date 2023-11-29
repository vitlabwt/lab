import React, { useState } from "react";

const Bill = () => {
  const [formData, setFormData] = useState({ unit: 0 });
  const [iscalculated, setiscalc] = useState(false);
  const [ans, setans] = useState(0);
  function changeHandler(event) {
    setFormData((prevData) => ({
      ...prevData,
      [event.target.name]: event.target.value,
    }));
  }
  async function submitHandler(event) {
    event.preventDefault();
    console.log(formData);
    const requestOptions = {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(formData),
    };
    const response = await fetch("api/v1/getBill", requestOptions);
    const data = await response.json();
    console.log(data, "hi htis is data");
    setans(data.data);
    setiscalc(true);
  }
  return (
    <div class="container mt-5">
      <h2 class="text-center mb-4">Electricity Bill Calculator</h2>

      <form
        onSubmit={submitHandler}
        className="flex flex-col w-full gap-y-4 mt-6"
      >
        <label className="w-full">
          <p className="text-[0.875rem] text-richblack-5 mb-1 leading-[1.375rem]">
            <sup className="text-pink-200">*</sup>
          </p>
          <input
            className="bg-richblack-800 rounded-[0.5rem] text-richblack-5 w-full p-[12px]"
            required
            type="number"
            value={formData.unit}
            onChange={changeHandler}
            placeholder="Enter email id"
            name="unit"
          />
        </label>

        <button className="bg-yellow-50 rounded-[8px] font-medium text-richblack-900 px-[12px] py-[8px]">
          Sign In
        </button>
      </form>
      {iscalculated ? (
        <>
          <h4>Electricity Bill Details:{ans}</h4>
        </>
      ) : (
        <></>
      )}
    </div>
  );
};

export default Bill;
