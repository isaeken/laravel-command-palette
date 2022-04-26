import React from 'react';

export default class Item extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      selected: props.selected ?? false,
      item: props.item,
    };
  }

  static getDerivedStateFromProps(props, state) {
    if (props.selected !== state.selected) {
      return {
        selected: props.selected,
      };
    }

    if (props.item !== state.item) {
      return {
        item: props.item,
      };
    }

    return null;
  }

  render() {
    return (
      <div
        className={
          this.state.selected ?
            "x-select-none x-cursor-pointer x-flex x-text-sm x-px-4 x-py-4 x-block x-m-2 x-rounded-lg x-bg-indigo-600 x-text-white" :
            "x-select-none x-cursor-pointer x-flex x-text-sm x-px-4 x-py-4 x-block x-m-2 x-rounded-lg x-bg-white hover:x-text-white x-bg-opacity-20 hover:x-bg-indigo-600"
        }>
        <div className="x-w-full">
          {this.state.item.text}
        </div>
        <div className="x-text-right x-w-24 text-xs x-opacity-50">
          Jump to...
        </div>
      </div>
    );
  }
}