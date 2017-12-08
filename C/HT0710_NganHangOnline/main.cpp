#include <stdio.h>
#include <conio.h>

	
/*VIET CHUONG TRINH TINH TIEN NGAN HANG. 
		- NHAP VAO SO TIEN CUA BAN: 
		- CHON NGAN HANG CUA BAN:
		- NEU NGAN HANG == VIETCOMBANK ==> (phi RUT TIEN = 1.100D)
		- NEU NGAN HANG != VIETCOMBANK ==> (PHI TUT TIEN = 3.300D)
		- CAC NGAN HANG : 1 2 3 4
		+ VIETCOMBANK = 1
		+ VIETINBANK = 2
		+ AGRIBANK = 3
		+ SACOMBANK = 4
		*/
int main(){
	int nganhang = 0;
	double tien_stock = 50000000.0;
	double tientru = 0.0;
	double sodu = 0.0;
//	double sodu = 0.0;
	
	
	printf("|| HE THONG RUT TIEN NGAN HANG ONLINE VIETNAM || ");
	printf("\n \t WELCOME TO MY SERVICES !! ");
	printf("\n The cua ban la ngan hang nao ?");
	printf("\n\n \t NEU TAI KHOAN CUA BAN LA NGAN HANG \n \t VIETCOMBANK GO PHIM 1\n \t VIETINBANK  GO PHIM 2 \n \t AGRIBANK    GO PHIM 3 \n \t SACOMBANK   GO PHIM 4");
	
	printf("\n\nNGAN HANG CUA TOI LA: ");
	scanf("%d",&nganhang);
	//DIEU KIEN CHON NGAN HANG //
		if(nganhang == 1){
			printf("\n \t BAN DA CHON NGAN HANG VIETCOMBANK \n");
			printf("\n SO TIEN CUA BAN HIEN TAI LA: %.2lf",tien_stock);
			printf("\nNhap vao so tien ban can rut: ");
			scanf("%lf",&tientru);
				if(tientru <= (tien_stock - 1100.0)){
			sodu = tien_stock - tientru - 1100.00;
			printf("\n \n \t SO TIEN BAN DA RUT : %.2lf VND",tientru);
			printf("\n \n \t SO DU TRONG TAI KHOAN CUA BAN LA : %.2lf VND",sodu);
			printf("\n \n \t PHI DICH VU LA : 1.100 VND");
				getch();
				}
				else{
					printf("SO TIEN CUA BAN KHONG DU DE THUC HIEN GIAO DICH NAY");
				}
		}
		else if(nganhang == 2){
			printf("\n \t BAN DA CHON NGAN HANG VIETINBANK \n ");
			printf("\n SO TIEN CUA BAN HIEN TAI LA: %.2lf",tien_stock);
			printf("\nNhap vao so tien ban can rut: ");
			scanf("%lf",&tientru);
				if(tientru <= (tien_stock - 3300.0)){
			sodu = tien_stock - tientru - 3300.00;
			printf("\n \n \t SO TIEN BAN DA RUT : %.2lf VND",tientru);
			printf("\n \n \t SO DU TRONG TAI KHOAN CUA BAN LA : %.2lf VND",sodu);
			printf("\n \n \t PHI DICH VU LA : 3.300 VND");
			getch();
				}
				else{
					printf("SO TIEN CUA BAN KHONG DU DE THUC HIEN GIAO DICH NAY");
				}
		}
		else if(nganhang == 3){
			printf("\n \t BAN DA CHON NGAN HANG AGRIBANK \n ");
			printf("\n SO TIEN CUA BAN HIEN TAI LA: %.2lf",tien_stock);
			printf("\nNhap vao so tien ban can rut: ");
			scanf("%lf",&tientru);
				if(tientru <= (tien_stock - 3300.0)){
			sodu = tien_stock - tientru - 3300.00;
			printf("\n \n \t SO TIEN BAN DA RUT : %.2lf VND",tientru);
			printf("\n \n \t SO DU TRONG TAI KHOAN CUA BAN LA : %.2lf VND",sodu);
			printf("\n \n \t PHI DICH VU LA : 3.300 VND");
			getch();
				}
				else{
					printf("SO TIEN CUA BAN KHONG DU DE THUC HIEN GIAO DICH NAY");
				}
				
		}
		else if(nganhang == 4){
			printf("\n \t BAN DA CHON NGAN HANG SACOMBANK \n ");
			printf("\n SO TIEN CUA BAN HIEN TAI LA: %.2lf",tien_stock);
			printf("\nNhap vao so tien ban can rut: ");
			scanf("%lf",&tientru);
				if(tientru <= (tien_stock - 3300.0)){
			sodu = tien_stock - tientru - 3300.00;
			printf("\n \n \t SO TIEN BAN DA RUT : %.2lf VND",tientru);
			printf("\n \n \t SO DU TRONG TAI KHOAN CUA BAN LA : %.2lf VND",sodu);
			printf("\n \n \t PHI DICH VU LA : 3.300 VND");
			getch();
				}
				else{
					printf("SO TIEN CUA BAN KHONG DU DE THUC HIEN GIAO DICH NAY");
				}
		}
	
	else if(nganhang > 5{
	// DIEU KIEN CHON NGAN HANG //
		printf("BAN CHON NGAN HANG KHONG CHINH XAC !! ");
	}
	x
}
