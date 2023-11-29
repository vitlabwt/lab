import React from 'react';
import { Jumbotron } from 'react-bootstrap';

// Define the custom background color class
const customBgColor = {
    backgroundColor: '#F7FF7',
};

function Welcome(props) {
    return (
        <Jumbotron style={customBgColor} className="text-black">
            <h1>{props.heading}</h1>
            <blockquote className="blockquote mb-0">
                <p>{props.quote}</p>
                <footer className="blockquote-footer">{props.footer}</footer>
            </blockquote>
        </Jumbotron>
    );
}

export default Welcome;
