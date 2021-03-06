import * as React from 'react';
import * as Icons from '@mui/icons-material';

function upperFirst(string) {
  return string.slice(0, 1).toUpperCase() + string.slice(1, string.length);
}

function fixIconName(string) {
  const name = string.split('-').map(upperFirst).join('');

  if (name === '3dRotation') {
    return 'ThreeDRotation'
  } else if (name === '4k') {
    return 'FourK'
  } else if (name === '360') {
    return 'ThreeSixty'
  }

  return name;
}

export default class DynamicIcon extends React.Component {
  constructor(props) {
    super(props);
  }

  render() {
    return React.createElement(
      Icons[fixIconName(this.props.iconName)],
      {className: this.props.className}
    );
  }
}