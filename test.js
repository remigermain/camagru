// ************************************************************************** //
//                                                          LE - /            //
//                                                              /             //
//   test.js                                          .::    .:/ .      .::   //
//                                                 +:+:+   +:    +:  +:+:+    //
//   By: rgermain <marvin@le-101.fr>                +:+   +:    +:    +:+     //
//                                                 #+#   #+    #+    #+#      //
//   Created: 2019/07/07 09:41:52 by rgermain     #+#   ##    ##    #+#       //
//   Updated: 2019/07/07 09:55:14 by rgermain    ###    #+. /#+    ###.fr     //
//                                                         /                  //
//                                                        /                   //
// ************************************************************************** //

//const obj = {
//	time: 5,
//	sum: (a, b) => a + b
//}

//console.log(obj);

/*const array = [
	{
		name: "remi",
		num: "0656423145"
	}, 
	{
		name: "jean",
		num: "0656423145"
	},
	{
		name: "kevin",
		num: "0656423145"
	}
];

const found = array[array.findIndex(el => el.name == "kevin")].num;

console.log(found);*/

//const str = "salut les amis comment ca va ?";

//console.log(str.split("co"));


const array = [1, 2, 3];

const ret = array.reduce((pile, el) => pile * el / 7884 * 4, 1);

console.log(ret);
